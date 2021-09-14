<?php
/**
 * Mink account ajax menu test class.
 *
 * PHP version 7
 *
 * Copyright (C) Villanova University 2011.
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
 * @package  Tests
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org Main Page
 */
namespace VuFindTest\Mink;

/**
 * Mink account ajax menu test class.
 *
 * Class must be final due to use of "new static()" by LiveDatabaseTrait.
 *
 * @category VuFind
 * @package  Tests
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org Main Page
 * @retry    4
 */
final class AccountMenuTest extends \VuFindTest\Integration\MinkTestCase
{
    use \VuFindTest\Feature\LiveDatabaseTrait;
    use \VuFindTest\Feature\UserCreationTrait;
    use \VuFindTest\Feature\DemoDriverTestTrait;

    /**
     * Standard setup method.
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        static::failIfUsersExist();
    }

    /**
     * Standard setup + login
     *
     * @return void
     */
    public function setUp(): void
    {
        // Give up if we're not running in CI:
        if (!$this->continuousIntegrationRunning()) {
            $this->markTestSkipped('Continuous integration not running.');
            return;
        }
        // Setup config
        $this->changeConfigs(
            [
            'Demo' => $this->getDemoIniOverrides(),
            'config' => [
                'Catalog' => ['driver' => 'Demo'],
                'Authentication' => [
                    'enableAjax' => true,
                    'enableDropdown' => false
                ]
            ]
            ]
        );
    }

    /**
     * Create a specific state in the account ajax storage.
     *
     * Cleared when browser closes.
     * If run multiple times in one test function, manually clear cache.
     *
     * @return void
     */
    protected function setJSStorage($states)
    {
        $session = $this->getMinkSession();
        $js = '';
        foreach ($states as $key => $state) {
            $js .= 'sessionStorage.setItem(\'vf-account-status-' . $key . '\', \'' . json_encode($state) . '\');';
        }
        $session->evaluateScript($js);
    }

    /**
     * Get associative array of storage state
     *
     * @return array
     */
    protected function getJSStorage()
    {
        $session = $this->getMinkSession();
        return $session->evaluateScript(
            'return {' .
            '  "checkedOut": sessionStorage.getItem("vf-account-status-checkedOut"),' .
            '  "fines": sessionStorage.getItem("vf-account-status-fines"),' .
            '  "holds": sessionStorage.getItem("vf-account-status-holds"),' .
            '  "illRequests": sessionStorage.getItem("vf-account-status-illRequests"),' .
            '  "storageRetrievalRequests": sessionStorage.getItem("vf-account-status-storageRetrievalRequests"),' .
            '}'
        );
    }

    /**
     * Establish the fines in the session that will be used by various tests below...
     *
     * @return object
     */
    protected function setUpFinesEnvironment()
    {
        // Seed some fines
        $this->setJSStorage(['fines' => ['value' => 30.5, 'display' => '$30.50']]);
        $session = $this->getMinkSession();
        $session->reload();
        $this->snooze();
        return $session->getPage();
    }

    /**
     * Test that the menu is absent when enableAjax is true and enableDropdown
     * is false.
     *
     * @retryCallback tearDownAfterClass
     *
     * @return void
     */
    public function testMenuOffAjaxNoDropdown()
    {
        // Create user
        $session = $this->getMinkSession();
        $session->visit($this->getVuFindUrl());
        $page = $session->getPage();
        $this->clickCss($page, '#loginOptions a');
        $this->snooze();
        $this->clickCss($page, '.modal-body .createAccountLink');
        $this->snooze();
        $this->fillInAccountForm($page);
        $this->clickCss($page, '.modal-body .btn.btn-primary');
        $this->snooze();

        // Seed some fines
        $page = $this->setUpFinesEnvironment();
        $menu = $page->findAll('css', '#login-dropdown');
        $this->assertEquals(0, count($menu));
        $stati = $page->findAll('css', '.account-menu .fines-status.hidden');
        $this->assertEquals(0, count($stati));
    }

    /**
     * Test that the menu is absent when enableAjax is false and enableDropdown
     * is false.
     *
     * @depends testMenuOffAjaxNoDropdown
     *
     * @return void
     */
    public function testMenuOffNoAjaxNoDropdown()
    {
        // Nothing on
        $this->changeConfigs(
            [
                'config' => [
                    'Authentication' => [
                        'enableAjax' => false,
                        'enableDropdown' => false
                    ]
                ]
            ]
        );
        $this->login();
        $this->snooze();
        $page = $this->setUpFinesEnvironment();
        $menu = $page->findAll('css', '#login-dropdown');
        $this->assertEquals(0, count($menu));
        $stati = $page->findAll('css', '.account-menu .fines-status.hidden');
        $this->assertEquals(1, count($stati));
    }

    /**
     * Test that the menu is absent when enableAjax is false and enableDropdown
     * is true.
     *
     * @depends testMenuOffAjaxNoDropdown
     *
     * @return void
     */
    public function testMenuOffNoAjaxDropdown()
    {
        $this->changeConfigs(
            [
                'config' => [
                    'Authentication' => [
                        'enableAjax' => false,
                        'enableDropdown' => true
                    ]
                ]
            ]
        );
        $this->login();
        $this->snooze();
        $page = $this->setUpFinesEnvironment();
        $menu = $page->findAll('css', '#login-dropdown');
        $this->assertEquals(1, count($menu));
        $stati = $page->findAll('css', '.account-menu .fines-status.hidden');
        $this->assertEquals(2, count($stati)); // one in menu, one in dropdown
    }

    /**
     * Test that the menu is absent when enableAjax is true and enableDropdown
     * is true.
     *
     * @depends testMenuOffAjaxNoDropdown
     *
     * @return void
     */
    public function testMenuOffAjaxDropdown()
    {
        $this->changeConfigs(
            [
                'config' => [
                    'Authentication' => [
                        'enableAjax' => true,
                        'enableDropdown' => true
                    ]
                ]
            ]
        );
        $this->login();
        $this->snooze();
        $page = $this->setUpFinesEnvironment();
        $menu = $page->findAll('css', '#login-dropdown');
        $this->assertEquals(1, count($menu));
        $stati = $page->findAll('css', '.account-menu .fines-status.hidden');
        $this->assertEquals(0, count($stati));
    }

    /**
     * Set some values and delete them to test VuFind.account.clearCache
     * with parameters.
     *
     * @return void
     */
    public function testIndividualCacheClearing()
    {
        $session = $this->getMinkSession();
        $session->visit($this->getVuFindUrl());
        $this->snooze();
        // Seed some fines
        $this->setJSStorage(['fines' => ['value' => 30.5, 'display' => '$30.50']]);
        // Clear different cache
        $session->evaluateScript('VuFind.account.clearCache("holds");');
        $storage = $this->getJSStorage();
        $this->assertNotNull($storage['fines']);
        // Clear correct cache
        $session->evaluateScript('VuFind.account.clearCache("fines");');
        $storage = $this->getJSStorage();
        $this->assertNull($storage['fines']);
    }

    /**
     * Set some values and delete them to test VuFind.account.clearCache
     * without parameters.
     *
     * @return void
     */
    public function testGlobalCacheClearing()
    {
        $session = $this->login();
        // Seed some fines
        $this->setJSStorage(['fines' => ['value' => 30.5, 'display' => '$30.50']]);
        $storage = $this->getJSStorage();
        $this->assertNotNull($storage['fines']);
        // Clear all cache
        $session->evaluateScript('VuFind.account.clearCache();');
        $storage = $this->getJSStorage();
        $this->assertNull($storage['fines']);
    }

    /**
     * Utility class to login
     *
     * @return \Behat\Mink\Session
     */
    protected function login()
    {
        $session = $this->getMinkSession();
        $session->visit($this->getVuFindUrl());
        $page = $session->getPage();
        $this->clickCss($page, '#loginOptions a');
        $this->snooze();
        $this->fillInLoginForm($page, 'username1', 'test');
        $this->clickCss($page, '.modal-body .btn.btn-primary');
        $this->snooze();
        return $session;
    }

    /**
     * Abstracted test to set storage and check if the icon is correct
     *
     * @return void
     */
    protected function checkIcon($storage, $checkClass)
    {
        $session = $this->getMinkSession();
        $session->visit($this->getVuFindUrl());
        foreach ($storage as $item) {
            $this->snooze();
            $this->setJSStorage($item);
            $session->reload();
            $page = $session->getPage();
            $this->findCss($page, '#account-icon ' . $checkClass);
            foreach ($item as $key => $value) {
                $session->evaluateScript('VuFind.account.clearCache("' . $key . '");');
            }
        }
    }

    /**
     * Check cases that don't change the account icon
     *
     * @return void
     */
    public function testIconNone()
    {
        $this->login();
        $storage = [
            // No fines
            ['fines' => ['value' => 0, 'display' => 'ZILTCH']],
            // Holds in transit only
            ['holds' => ['in_transit' => 1, 'available' => 0]],
            // ILL Requests in transit only
            ['illRequests' => ['in_transit' => 1, 'available' => 0]],
            // Storage Retrievals in transit only
            ['storageRetrievalRequests' => ['in_transit' => 1, 'available' => 0]]
        ];
        $this->checkIcon($storage, '.ajax-status-none');
    }

    /**
     * Check cases that change the account icon to a happy bell
     *
     * @return void
     */
    public function testIconGood()
    {
        $this->login();
        $storage = [
            // Holds available
            ['holds' => ['in_transit' => 0, 'available' => 1]],
            // ILL Requests available
            ['illRequests' => ['in_transit' => 0, 'available' => 1]],
            // Storage Retrievals available
            ['storageRetrievalRequests' => ['in_transit' => 0, 'available' => 1]]
        ];
        $this->checkIcon($storage, '.ajax-status-good');
    }

    /**
     * Check cases that change the account icon to a concerned bell
     *
     * @return void
     */
    public function testIconWarning()
    {
        $this->login();
        $storage = [
            // Checked out due soon
            ['checkedOut' => ['warn' => 1]]
        ];
        $this->checkIcon($storage, '.ajax-status-warning');
    }

    /**
     * Check cases that change the account icon to an alarming triangle
     *
     * @return void
     */
    public function testIconDanger()
    {
        $this->login();
        $storage = [
            // User has fines
            ['fines' => ['value' => 1000000, 'display' => '$...yikes']],
            // Checkedout overdue
            ['checkedOut' => ['overdue' => 1]],
        ];
        $this->checkIcon($storage, '.ajax-status-danger');
    }

    /**
     * More urgent cases should override lower cases
     *
     * Danger > Warning > Good > None
     *
     * @return void
     */
    public function testIconClashes()
    {
        $this->login();
        // Danger overrides warning
        $this->checkIcon(
            [['checkedOut' => ['warn' => 2, 'overdue' => 1]]],
            '.ajax-status-danger'
        );
        // Danger overrides good
        $this->checkIcon(
            [
                [
                    'checkedOut' => ['overdue' => 1],
                    'holds' => ['available' => 1]
                ]
            ],
            '.ajax-status-danger'
        );
        // Warning overrides good
        $this->checkIcon(
            [
                [
                    'checkedOut' => ['warn' => 1],
                    'holds' => ['available' => 1]
                ]
            ],
            '.ajax-status-warning'
        );
        // Good overrides none
        $this->checkIcon(
            [
                [
                    'holds' => ['available' => 1],
                    'fines' => ['value' => 0, 'display' => 'none']
                ]
            ],
            '.ajax-status-good'
        );
    }

    /**
     * Standard teardown method.
     *
     * @return void
     */
    public static function tearDownAfterClass(): void
    {
        static::removeUsers(['username1']);
    }
}
