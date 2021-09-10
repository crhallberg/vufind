<?php
/**
 * Icon View Helper Test Class
 *
 * PHP version 7
 *
 * Copyright (C) Villanova University 2021.
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
 * @link     https://vufind.org/wiki/development:testing:unit_tests Wiki
 */
namespace VuFindTest\View\Helper\Root;

use Laminas\Cache\Storage\Adapter\BlackHole;
use Laminas\Cache\Storage\StorageInterface;
use Laminas\View\Helper\EscapeHtmlAttr;
use Laminas\View\Helper\HeadLink;
use VuFind\View\Helper\Root\Icon;
use VuFindTheme\View\Helper\ImageLink;

/**
 * Icon View Helper Test Class
 *
 * @category VuFind
 * @package  Tests
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development:testing:unit_tests Wiki
 */
class IconTest extends \PHPUnit\Framework\TestCase
{
    use \VuFindTest\Feature\ViewTrait;

    /**
     * Get a default test configuration.
     *
     * @return array
     */
    protected function getDefaultTestConfig(): array
    {
        return [
            'sets' => [
                'FontAwesome' => [
                    'template' => 'font',
                    'prefix' => 'fa fa-',
                    'src' => 'vendor/font-awesome.min.css',
                ],
                'Fugue' => [
                    'template' => 'images',
                    'src' => 'icons',
                ],
                'FakeSprite' => [
                    'template' => 'svg-sprite',
                    'src' => 'mysprites.svg',
                ]
            ],
            'aliases' => [
                'bar' => 'Fugue:baz.png',
                'xyzzy' => 'FakeSprite:sprite',
            ],
        ];
    }

    /**
     * Get a mock HeadLink helper configured with standard expectations.
     *
     * @return HeadLink
     */
    protected function getMockHeadLink(): HeadLink
    {
        $mock = $this->getMockBuilder(HeadLink::class)
            ->addMethods(['appendStylesheet'])
            ->disableOriginalConstructor()->getMock();
        $mock->expects($this->once())->method('appendStylesheet')
            ->with($this->equalTo('icon-helper.css'));
        return $mock;
    }

    /**
     * Get a mock ImageLink helper
     *
     * @param string $expected Expected image
     *
     * @return ImageLink
     */
    protected function getMockImageLink(string $expected): ImageLink
    {
        $mock = $this->getMockBuilder(ImageLink::class)
            ->disableOriginalConstructor()->getMock();
        $mock->expects($this->once())->method('__invoke')
            ->with($this->equalTo($expected))
            ->will($this->returnValue(basename($expected)));
        return $mock;
    }

    /**
     * Get an Icon helper
     *
     * @param array            $config   Icon helper configuration array
     * @param StorageInterface $cache    Cache storage adapter (null for BlackHole)
     * @param HeadLink         $headLink HeadLink helper (null for mock)
     * @param array            $plugins  Array of extra plugins for renderer
     *
     * @return Icon
     */
    protected function getIconHelper(
        array $config = null,
        StorageInterface $cache = null,
        HeadLink $headLink = null,
        array $plugins = []
    ): Icon {
        $icon = new Icon(
            $config ?? $this->getDefaultTestConfig(),
            $cache ?? new BlackHole(),
            new EscapeHtmlAttr(),
            $headLink ?? $this->getMockHeadLink()
        );
        $icon->setView($this->getPhpRenderer($plugins));
        return $icon;
    }

    /**
     * Test that we can generate a font-based icon.
     *
     * @return void
     */
    public function testFontIcon(): void
    {
        $helper = $this->getIconHelper();
        $expected = '<span class="icon--font fa&#x20;fa-foo" '
            . 'role="img" aria-hidden="true"></span>';
        $this->assertEquals($expected, trim($helper('foo')));
    }

    /**
     * Test that we can generate a font-based icon with extra attributes.
     *
     * @return void
     */
    public function testFontIconWithExtras(): void
    {
        $helper = $this->getIconHelper();
        $expected = '<span class="icon--font fa&#x20;fa-foo" '
            . 'bar="baz" role="img" aria-hidden="true"></span>';
        $this->assertEquals($expected, trim($helper('foo', ['bar' => 'baz'])));

        // Add class to class
        $expected = '<span class="icon--font fa&#x20;fa-foo foo-bar" role="img" aria-hidden="true"></span>';
        $this->assertEquals($expected, trim($helper('foo', ['class' => 'foo-bar'])));

        // Shortcut
        $this->assertEquals($expected, trim($helper('foo', 'foo-bar')));
    }

    /**
     * Test that caching works correctly.
     *
     * @return void
     */
    public function testCaching(): void
    {
        $expected = '<span class="icon--font fa&#x20;fa-foo" '
            . 'bar="baz" role="img" aria-hidden="true"></span>' . "\n";
        $key = 'foo+c0dc783820069fb9337be7366f7945bf';

        // Create a mock cache that simulates normal cache functionality;
        // the first call to getItem returns null, then it expects a call
        // to setItem, and then the second call to getItem will return an
        // expected value.
        $cache = $this->getMockBuilder(StorageInterface::class)->getMock();
        $cache->expects($this->exactly(2))->method('getItem')
            ->with($this->equalTo($key))
            ->willReturnOnConsecutiveCalls(null, $expected);
        $cache->expects($this->once())->method('setItem')
            ->with($this->equalTo($key), $this->equalTo($expected));

        // Invoke the helper twice to meet the expectations of the cache mock:
        $helper = $this->getIconHelper(null, $cache);
        $helper('foo', ['bar' => 'baz']);
        $helper('foo', ['bar' => 'baz']);
    }

    /**
     * Test that we can generate an image-based icon.
     *
     * @return void
     */
    public function testImageIcon(): void
    {
        $plugins = ['imageLink' => $this->getMockImageLink('icons/baz.png')];
        $helper = $this->getIconHelper(null, null, null, $plugins);
        $expected = '<img class="icon--img" src="baz.png" aria-hidden="true"/>';
        $this->assertEquals($expected, trim($helper('bar')));
    }

    /**
     * Test that we can generate an SVG icon.
     *
     * @return void
     */
    public function testSvgIcon(): void
    {
        $plugins = ['imageLink' => $this->getMockImageLink('mysprites.svg')];
        $helper = $this->getIconHelper(null, null, null, $plugins);
        $expected = <<<EXPECTED
<svg class="icon--svg" aria-hidden="true">
    <use xlink:href="mysprites.svg#sprite"></use>
</svg>
EXPECTED;
        $this->assertEquals($expected, trim($helper('xyzzy')));
    }
}
