<?php

namespace MyMod\Agent2\Controller\Adminhtml\Index;

/**
 * Class Save
 *
 * @package MyMod\Agent2\Controller\Adminhtml\Index
 */
class Save extends \Magento\Backend\App\Action
{
    /** @var $resultFactory */
    public $resultFactory;

    /** @var \Magento\Framework\Registry */
    public $coreRegistry;

    /** @var $info */
    public $info;

    /** @var \MyMod\Agent2\Model\ResourceModel\Info */
    public $infoResource;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \MyMod\Agent2\Model\InfoFactory $info,
        \MyMod\Agent2\Model\ResourceModel\Info $infoResource
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
        $firstName = $this->getRequest()->getParam(\MyMod\Agent2\Model\Info::COLUMN_FIRST_NAME);
        $lastName = $this->getRequest()->getParam(\MyMod\Agent2\Model\Info::COLUMN_LAST_NAME);
        $email = $this->getRequest()->getParam(\MyMod\Agent2\Model\Info::COLUMN_EMAIL);
        $phone = $this->getRequest()->getParam(\MyMod\Agent2\Model\Info::COLUMN_PHONE);
        $image = $this->getRequest()->getParam(\MyMod\Agent2\Model\Info::COLUMN_AGENT_IMAGE);

        $infoModel = $this->infoFactory->create();

        if ($id) {
            $image = '';
        } else {
            $image = $image[0]['name'];
        }

        $infoModel->setData([
            \MyMod\Agent2\Model\Info::COLUMN_FIRST_NAME => $firstName,
            \MyMod\Agent2\Model\Info::COLUMN_LAST_NAME => $lastName,
            \MyMod\Agent2\Model\Info::COLUMN_EMAIL => $email,
            \MyMod\Agent2\Model\Info::COLUMN_PHONE => $phone,
            \MyMod\Agent2\Model\Info::COLUMN_AGENT_IMAGE => $image

        ]);
        if ($id) {
            $infoModel->load($id);
            $infoModel->setData([
                \MyMod\Agent2\Model\Info::COLUMN_ID => $id,
                \MyMod\Agent2\Model\Info::COLUMN_FIRST_NAME => $firstName,
                \MyMod\Agent2\Model\Info::COLUMN_LAST_NAME => $lastName,
                \MyMod\Agent2\Model\Info::COLUMN_EMAIL => $email,
                \MyMod\Agent2\Model\Info::COLUMN_PHONE => $phone
            ]);
        }

        try {
            $this->infoResource->save($infoModel);
            $this->messageManager->addSuccessMessage(__('Your Agent2 Information has been Saved'));
            return $resultRedirect->setPath('agent/index/index');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Information saved failed '.$e->getMessage());
        }
    }
}
