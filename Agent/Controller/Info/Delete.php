<?php
namespace MyMod\Agent\Controller\Info;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action {
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /** @var \MyMod\Agent\Model\ResourceModel\Info\CollectionFactory */
    public $infoCollection;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        \MyMod\Agent\Model\ResourceModel\Info\CollectionFactory $infoCollection,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->infoCollection = $infoCollection;
        $this->cacheTypeList = $cacheTypeList;
        $this->cacheFrontendPool = $cacheFrontendPool;
        $this->pageFactory = $pageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if (isset($id) && !empty($id)) {
            $ids[] = $id;
        }
        if (!empty($ids) && is_array($ids)) {
            /** @var $info */
            $info = $this->infoCollection->create()->addFieldToFilter('id', ['in' => $ids]);
            $info->walk('delete');
        }
        $types = array('config','layout','block_html','collections','reflection','db_ddl','eav','config_integration','config_integration_api','full_page','translate','config_webservice');
        foreach ($types as $type) {
            $this->cacheTypeList->cleanType($type);
        }
        foreach ($this->cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
        return $this->_redirect('agent/info/index');
    }
}
