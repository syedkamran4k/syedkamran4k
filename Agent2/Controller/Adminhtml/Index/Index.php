<?php


namespace MyMod\Agent2\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /** @var PageFactory  */
    public $resultPageFactory;
    public $ProxyCalledHelper;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \MyMod\Agent2\Helper\Proxytest $ProxyCalledHelper
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_ProxyCalledHelper = $ProxyCalledHelper;
    }

    public function execute()
    {
        /**
         * @var \Magento\Backend\Model\View\Result\Page $resultPage
         */
        $this->_ProxyCalledHelper->Proxycondition();
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('MyMod_Agent2::Agent2');
        $resultPage->getConfig()->getTitle()->prepend(__('Agent2 Information'));
        return $resultPage;
    }
}
