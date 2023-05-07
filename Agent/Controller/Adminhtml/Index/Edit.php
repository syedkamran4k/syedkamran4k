<?php

namespace MyMod\Agent\Controller\Adminhtml\Index;

/**
 * Class Edit
 *
 * @package MyMod\Agent\Controller\Adminhtml\Account
 */
class Edit extends \Magento\Backend\App\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory */
    public $resultPageFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    public $coreRegistry;

    /**
     * @var \MyMod\Agent\Model\ResourceModel\InfoFactory
     */
    public $infoFactory;

    /**
     * @var \MyMod\Agent\Model\ResourceModel\InfoFactory
     */
    public $infoResourceFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \MyMod\Agent\Model\ResourceModel\InfoFactory $infoResourceFactory,
        \MyMod\Agent\Model\InfoFactory $infoFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;
        $this->infoFactory = $infoFactory;
        $this->infoResource = $infoResourceFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \MyMod\Agent\Model\Info $infoModel */
        $infoModel = $this->infoFactory->create();

        $title = 'Add Information MyMod';
        if (isset($id) && !empty($id)) {
            /** @var \MyMod\Agent\Model\ResourceModel\Info $infoResource */
            $infoResource = $this->infoResource->create();
            $infoResource->load($infoModel, $id);
            $title = 'Edit Information MyMod';
        }

        $this->coreRegistry->register('agent_info', $infoModel);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('MyMod_Agent::Agent');
        $resultPage->getConfig()->getTitle()->prepend(__($title));
        return $resultPage;
    }
}
