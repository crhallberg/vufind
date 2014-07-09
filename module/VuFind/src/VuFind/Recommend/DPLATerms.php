<?php
/**
 * DPLATerms Recommendations Module
 *
 * PHP version 5
 *
 * Copyright (C) Villanova University 2010.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @category VuFind2
 * @package  Recommendations
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org/wiki/vufind2:recommendation_modules Wiki
 */
namespace VuFind\Recommend;

/**
 * DPLATerms Recommendations Module
 *
 * This class uses current search terms to query the DPLA API.
 *
 * @category VuFind2
 * @package  Recommendations
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org/wiki/vufind2:recommendation_modules Wiki
 */
class DPLATerms implements RecommendInterface
{
    protected $config;
    protected $client;
    protected $collapsedFacets;

    /**
     * Search results object
     *
     * @var \VuFind\Search\Base\Results
     */
    protected $searchObject;

    /**
     * Constructor
     *
     * @param WorldCatUtils $wcu WorldCat utilities object
     */
    public function __construct($config, $client)
    {
        $mainConfig = $config->get('config');
        $this->config = $mainConfig->DPLA;
        $this->client = $client;

        // Collapsed facets:
        $facetConfig = $config->get('facets');
        if (isset($facetConfig->Results_Settings->collapsedFacets)) {
            $this->collapsedFacets = $facetConfig->Results_Settings->collapsedFacets;
        }
    }

    /**
     * setConfig
     *
     * Store the configuration of the recommendation module.
     *
     * @param string $settings Settings from searches.ini.
     *
     * @return void
     */
    public function setConfig($settings)
    {
        //var_dump($settings);
    }

    /**
     * init
     *
     * Called at the end of the Search Params objects' initFromRequest() method.
     * This method is responsible for setting search parameters needed by the
     * recommendation module and for reading any existing search parameters that may
     * be needed.
     *
     * @param \VuFind\Search\Base\Params $params  Search parameter object
     * @param \Zend\StdLib\Parameters    $request Parameter object representing user
     * request.
     *
     * @return void
     */
    public function init($params, $request)
    {
        // No action needed.
    }

    /**
     * process
     *
     * Called after the Search Results object has performed its main search.  This
     * may be used to extract necessary information from the Search Results object
     * or to perform completely unrelated processing.
     *
     * @param \VuFind\Search\Base\Results $results Search results object
     *
     * @return void
     */
    public function process($results)
    {
        $this->searchObject = $results;
    }

    /**
     * Get terms related to the query.
     *
     * @return array
     */
    public function getResults()
    {
        // Extract the first search term from the search object:
        $search = $this->searchObject->getParams()->getQuery();
        $filters = $this->searchObject->getParams()->getFilters();
        $lookfor = ($search instanceof \VuFindSearch\Query\Query)
            ? $search->getString()
            : '';
        $formatMap = array(
            'authorStr'           => 'sourceResource.creator',
            'building'            => 'provider.name',
            'format'              => 'sourceResource.format',
            'geographic_facet'    => 'sourceResource.spatial.region',
            'institution'         => 'provider.name',
            'language'            => 'sourceResource.language.name',
            'publishDate'         => 'sourceResource.date.begin',
            //'genre_facet'         => 'Genre',
            //'hierarchy_top_title' => 'Collection',
            //'callnumber-first'    => 'Call Number',
            //'dewey-hundreds'      => 'Call Number',
        );
        $returnFields = array(
            'id',
            'dataProvider',
            'sourceResource.title',
            'sourceResource.description',
        );
        $params = array(
            'q' => $lookfor,
            'fields' => implode(',', $returnFields),
            'api_key' => $this->config->apiKey
        );
        foreach($filters as $field=>$filter) {
            $params[$formatMap[$field]] = implode(',', $filter);
        }

        $this->client->setUri('http://api.dp.la/v2/items');
        $this->client->setMethod('GET');
        $this->client->setParameterGet($params);
        $response = $this->client->send();

        $body = json_decode($response->getBody());

        if ($body->count == 0) {
            return array();
        }

        $results = array();
        $title = 'sourceResource.title';
        $desc = 'sourceResource.description';
        foreach ($body->docs as $doc) {
            $results[] = array(
                'title' => is_array($doc->$title)
                    ? current($doc->$title)
                    : $doc->$title,
                'provider' => is_array($doc->dataProvider)
                    ? current($doc->dataProvider)
                    : $doc->dataProvider,
                'link' => 'http://dp.la/item/'.$doc->id
            );
            if (isset($doc->$desc)) {
                $results['desc'] = is_array($doc->$desc)
                    ? current($doc->$desc)
                    : $doc->$desc;
            }
        }

        return $results;
    }

    /**
     * Return the list of facets configured to be collapsed
     *
     * @return array
     */
    public function isCollapsed()
    {
        if (empty($this->collapsedFacets)) {
            return true;
        } elseif ($this->collapsedFacets == '*') {
            return false;
        }
        return !strstr(strtolower($this->collapsedFacets), 'dpla');
    }
}