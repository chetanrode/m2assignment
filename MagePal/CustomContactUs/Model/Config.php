<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MagePal\CustomContactUs\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Contact\Model\ConfigInterface;

/**
 * Contact module configuration
 */
class Config implements ConfigInterface
{

    const XML_PATH_EMAIL_RECIPIENT_BCC = 'contact/email/recipient_email_bcc';
    const XML_PATH_EMAIL_RECIPIENT_CC = 'contact/email/recipient_email_cc';
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function emailTemplate()
    {
        return $this->scopeConfig->getValue(
            ConfigInterface::XML_PATH_EMAIL_TEMPLATE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function emailSender()
    {
        return $this->scopeConfig->getValue(
            ConfigInterface::XML_PATH_EMAIL_SENDER,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function emailRecipient()
    {
        return $this->scopeConfig->getValue(
            ConfigInterface::XML_PATH_EMAIL_RECIPIENT,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function emailRecipientBcc()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_EMAIL_RECIPIENT_BCC,
            ScopeInterface::SCOPE_STORE
        );
    }
    public function emailRecipientCc()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_EMAIL_RECIPIENT_CC,
            ScopeInterface::SCOPE_STORE
        );
    }
}
