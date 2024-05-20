<?php
declare(strict_types=1);

namespace Os\LastUnits\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    const IS_ENABLED = 'tag/last_units/is_enabled';
    const THRESHOLD = 'tag/last_units/threshold';
    const TEXT = 'tag/last_units/text';
    const CATEGORY_URL_KEY = 'tag/last_units/category_url_key';
    const SEO_CATEGORY_SUFFIX = 'catalog/seo/category_url_suffix';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return (bool)$this->scopeConfig->getValue(self::IS_ENABLED);
    }

    /**
     * @return int
     */
    public function getThreshold(): int
    {
        return (int)$this->scopeConfig->getValue(self::THRESHOLD);
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return (string)$this->scopeConfig->getValue(self::TEXT);
    }

    /**
     * @return string
     */
    public function getCategoryUrlKey(): string
    {
        return (string)$this->scopeConfig->getValue(self::CATEGORY_URL_KEY);
    }

    /**
     * @return string
     */
    public function getCategoryUrlSuffix(): string
    {
        return (string)$this->scopeConfig->getValue(self::SEO_CATEGORY_SUFFIX);
    }
}
