<?php
/**
 * Make tag view helper
 *
 * PHP version 7
 *
 * Copyright (C) Villanova University 2020.
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
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category VuFind
 * @package  View_Helpers
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development Wiki
 */
namespace VuFind\View\Helper\Root;

use Laminas\View\Helper\AbstractHelper;

/**
 * Make tag view helper
 *
 * @category VuFind
 * @package  View_Helpers
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development Wiki
 */
class MakeTag extends AbstractHelper
{
    /**
     * Render an HTML tag
     *
     * A string passed into $attrs will be treated like a class.
     * These two are equivalent:
     * > MakeTag('div', 'Success!', 'alert alert-success')
     * > MakeTag('div', 'Success!', ['class => 'alert alert-success'])
     *
     * @param string       $tagName  Element tag name
     * @param string       $contents Element contents (must be properly-formed HTML)
     * @param string|array $attrs    Tag attributes (associative array or class name)
     *
     * @return string HTML for an anchor tag
     */
    public function __invoke(string $tagName, string $contents, $attrs = [])
    {
        // $attrs not an object, interpret as class name
        if (!is_array($attrs)) {
            $attrs = !empty($attrs) ? ['class' => $attrs] : [];
        }

        // Compile attributes
        return $this->compileTag($tagName, $contents, $attrs);
    }

    /**
     * Turn associative array into a string of attributes in an anchor
     *
     * @param string $tagName   HTML tag name
     * @param string $innerHTML InnerHTML
     * @param array  $attrs     Tag attributes (associative array)
     *
     * @return string
     */
    protected function compileTag(string $tagName, string $innerHTML, array $attrs)
    {
        $escAttr = $this->getView()->plugin('escapeHtmlAttr');

        $anchor = '<' . $tagName;
        foreach ($attrs as $key => $val) {
            $anchor .= ' ' . $key;
            if ($val !== true) {
                $anchor .= '="' . $escAttr($val) . '"';
            }
        }

        $anchor .= '>' . $innerHTML . '</' . $tagName . '>';
        return $anchor;
    }
}