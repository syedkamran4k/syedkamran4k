<?php

namespace Pws\Form\Controller\Adminhtml\Index;

/**
 * Class Save
 *
 * @package Pws\Form\Controller\Adminhtml\Index
 */
class Save extends \Magento\Backend\App\Action
{
    /** @var $resultFactory */
    public $resultFactory;

    /** @var \Magento\Framework\Registry */
    public $coreRegistry;

    /** @var $info */
    public $info;

    /** @var \Pws\Form\Model\ResourceModel\Info */
    public $infoResource;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Pws\Form\Model\InfoFactory $info,
        \Pws\Form\Model\ResourceModel\Info $infoResource
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;
        $this->infoFactory = $info;
        $this->infoResource = $infoResource;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        $firstName = $this->getRequest()->getParam(\Pws\Form\Model\Info::COLUMN_FIRST_NAME);
        $lastName = $this->getRequest()->getParam(\Pws\Form\Model\Info::COLUMN_LAST_NAME);
        $address = $this->getRequest()->getParam(\Pws\Form\Model\Info::COLUMN_DESCRIPTION);
        $description = $this->getRequest()->getParam(\Pws\Form\Model\Info::COLUMN_ADDRESS);
        $phone = $this->getRequest()->getParam(\Pws\Form\Model\Info::COLUMN_PHONE);
//        $image = $this->getRequest()->getParam(\Pws\Form\Model\Info::COLUMN_AGENT_IMAGE);

        $infoModel = $this->infoFactory->create();

//        if ($id) {
//            $image = '';
//        } else {
//            $image = $image[0]['name'];
//        }

        $infoModel->setData([
            \Pws\Form\Model\Info::COLUMN_FIRST_NAME => $firstName,
            \Pws\Form\Model\Info::COLUMN_LAST_NAME => $lastName,
            \Pws\Form\Model\Info::COLUMN_ADDRESS => $address,
            \Pws\Form\Model\Info::COLUMN_DESCRIPTION => $description,
            \Pws\Form\Model\Info::COLUMN_PHONE => $phone,
//            \Pws\Form\Model\Info::COLUMN_AGENT_IMAGE => $image

        ]);
        if ($id) {
            $infoModel->load($id);
            $infoModel->setData([
                \Pws\Form\Model\Info::COLUMN_ID => $id,
                \Pws\Form\Model\Info::COLUMN_FIRST_NAME => $firstName,
                \Pws\Form\Model\Info::COLUMN_LAST_NAME => $lastName,
                \Pws\Form\Model\Info::COLUMN_ADDRESS => $address,
                \Pws\Form\Model\Info::COLUMN_DESCRIPTION => $description,
                \Pws\Form\Model\Info::COLUMN_PHONE => $phone

            ]);
        }

        try {
            $this->infoResource->save($infoModel);
            $this->messageManager->addSuccessMessage(__('Record Information has been Saved'));
            return $resultRedirect->setPath('form/index/index');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Information saved failed '.$e->getMessage());
        }
    }
}
