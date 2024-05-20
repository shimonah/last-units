<?php
declare(strict_types=1);

namespace Os\LastUnits\Block;

use Magento\Framework\View\Element\Template;
use Os\LastUnits\Helper\Config;

class Tag extends Template
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Config $config,
        Template\Context $context,
        array $data = []
    ) {
        $this->config = $config;

        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->config->getText();
    }

    /**
     * @return string
     */
    public function getCategoryUrl(): string
    {
        return $this->getUrl($this->config->getCategoryUrlKey() . $this->config->getCategoryUrlSuffix());
    }
}
