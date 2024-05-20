<?php

namespace Os\LastUnits\Test\Unit\Plugin\Block\Product\View;

use PHPUnit\Framework\TestCase;
use Os\LastUnits\Helper\Config;
use Magento\Framework\View\LayoutInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Magento\Catalog\Block\Product\View\Gallery as MagentoGallery;
use Os\LastUnits\Plugin\Block\Product\View\Gallery as GalleryPlugin;

class GalleryTest extends TestCase
{
    /**
     * @var Config|MockObject
     */
    private $config;

    /**
     * @var MagentoGallery|MockObject
     */
    private $magentoGallery;

    protected function setUp(): void
    {
        $this->layout = $this->getMockBuilder(LayoutInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->magentoGallery = $this->getMockBuilder(MagentoGallery::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->config = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginGallery = new GalleryPlugin($this->config);
    }

    public function testEnabledModuleRunsPlugin()
    {
        $result = '<span class="gallery-test">test</span>';
        $nameInLayout = 'product.info.media.image';

        $this->magentoGallery->expects($this->once())
            ->method('getNameInLayout')
            ->willReturn($nameInLayout);
        $this->config->expects($this->once())
            ->method('isEnabled')
            ->willReturn(true);

        $this->magentoGallery->expects($this->once())->method('getLayout');
        $this->magentoGallery->expects($this->once())->method('getProduct');

        $this->pluginGallery->afterToHtml($this->magentoGallery, $result);
    }
}
