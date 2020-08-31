<?php
namespace Scandiweb\CampaingButton\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;
use Scandiweb\CampaingButton\Helper\Data;

class Campaing extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface ScopeConfigInterface
     */
    protected $_scopeConfig;

    protected $_helperData;
    /**
     * Link constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Data $helperData,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_scopeConfig = $scopeConfig;
        $this->_helperData = $helperData;
    }

    public function getHexValue()
    {
        return $this->_helperData->getHexValue();
    }

}