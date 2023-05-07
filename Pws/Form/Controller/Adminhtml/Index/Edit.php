<?php

namespace Pws\Form\Controller\Adminhtml\Index;

/**
 * Class Edit
 *
 * @package Pws\Form\Controller\Adminhtml\Account
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
     * @var \Pws\Form\Model\ResourceModel\InfoFactory
     */
    public $infoFactory;

    /**
     * @var \Pws\Form\Model\ResourceModel\InfoFactory
     */
    public $infoResourceFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Pws\Form\Model\ResourceModel\InfoFactory $infoResourceFactory,
        \Pws\Form\Model\InfoFactory $infoFactory
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
        /** @var \Pws\Form\Model\Info $infoModel */
        $infoModel = $this->infoFactory->create();

        $title = 'Add Information';
        if (isset($id) && !empty($id)) {
            /** @var \Pws\Form\Model\ResourceModel\Info $infoResource */
            $infoResource = $this->infoResource->create();
            $infoResource->load($infoModel, $id);
            $title = 'Edit Information';
        }

        $this->coreRegistry->register('form_info', $infoModel);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Pws_Form::Form');
        $resultPage->getConfig()->getTitle()->prepend(__($title));
        return $resultPage;
    }
}
