<?php
namespace Scandiweb\Cms\Block;

use Magento\Cms\Model\Page;
use Magento\Store\Model\StoreRepository;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;

class Link extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Cms\Model\Page Page
     */
    protected $_page;

    /**
     * @var \Magento\Store\Model\StoreRepository StoreRepository
     */
    protected $_storeRepository;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * Link constructor.
     * @param Page $page
     * @param StoreRepository $storeRepository
     * @param ScopeConfigInterface $scopeConfig
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Page $page,
        StoreRepository $storeRepository,
        ScopeConfigInterface $scopeConfig,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_page = $page;
        $this->_storeRepository = $storeRepository;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Check if is cms page
     *
     * @return bool
     */
    public function isCsmPage()
    {
        $currentFullAction = $this->getRequest()->getFullActionName();
        if(in_array($currentFullAction, ['cms_index_index','cms_page_view'])) {
            return true;
        }
        return false;
    }


    /**
     *
     *  2. The block should be able to read the CMS page’s id and to check if the page is used on multiple store views/websites;
     *  3. If so it should add a hreflang meta tag to the head;
     *
     * @return array|\Magento\Store\Api\Data\StoreInterface[]
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStoresRelatedToCms()
    {
        $stores = $this->_page->getStores();
        if ($stores[0] == 0 ) {
            return $this->_storeRepository->getList();
        } elseif ( count($stores) > 1 ) {
            $storeList = [];
            foreach ($stores as $storeId) {
                $storeList [] = $this->_storeRepository->getById($storeId);
            }
            return $storeList ;
        }
        return [];
    }

    public function getIdentifier() {
        return $this->_page->getIdentifier();
    }

    /**
     * 4. If the meta tag is displayed - it should display language of the store, like “en-gb”, “en-us”, etc. As metatag should have specific values for each country;
     * 5. Support the fact that each store should have a different language pair.
     *
     * @param $storeId
     * @return mixed
     */
    public function getLocaleForStores($storeId)
    {
        return $this->_scopeConfig->getValue('general/locale/code', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
    }

}