<?php
namespace Scandiweb\CampaingButton\Helper;

use Magento\Framework\App\Helper\Context;
use \Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ConfigResource\ConfigInterface;

use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    const CAMPAING_HEX_VALUE = 'campaingbutton/general/hex_color';
    const SCOPE_TYPE_STORE =  'stores';

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManage;

    /***
     * @var ConfigInterface
     */
    protected $_configInterface;


    protected $_cacheTypeList;
    protected $_cacheFrontendPool;


    public function __construct(
        Context $context,
        StoreManagerInterface $storeManage,
        ConfigInterface $configInterface,
        TypeListInterface $cacheTypeList,
        Pool $cacheFrontendPool
    )
    {
        parent::__construct($context);
        $this->_storeManager = $storeManage;
        $this->_configInterface = $configInterface;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;

    }

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function getCurrentStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }


    public function getHexValue()
    {
        return $this->scopeConfig->getValue(self::CAMPAING_HEX_VALUE, \Magento\Store\Model\ScopeInterface::SCOPE_STORES, $this->getCurrentStoreId());
    }


    public function setHexValueForButtionCampaing($hex,$storeId)
    {
        $this->_configInterface->saveConfig(self::CAMPAING_HEX_VALUE ,$hex ,\Magento\Store\Model\ScopeInterface::SCOPE_STORES, $storeId);
        $this->cleanCache();
    }

    public function removeHexValueForButtionCampaing($storeId)
    {
        $this->_configInterface->deleteConfig(self::CAMPAING_HEX_VALUE,\Magento\Store\Model\ScopeInterface::SCOPE_STORES,$storeId);
        $this->cleanCache();
    }

    public function cleanCache()
    {
        $_types = [
            'config',
            'full_page'
        ];

        foreach ($_types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            #$cacheFrontend->getBackend()->clean();
        }
    }

}

