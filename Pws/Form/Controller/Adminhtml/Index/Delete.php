<?php

namespace Pws\Form\Controller\Adminhtml\Index;

class Delete extends \Magento\Backend\App\Action
{
    /** @var \Pws\Form\Model\ResourceModel\Info\CollectionFactory */
    public $infoCollection;

    /** @var \Magento\Ui\Component\MassAction\Filter */
    public $filter;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Pws\Form\Model\ResourceModel\Info\CollectionFactory $infoCollection
    ) {
        parent::__construct($context);
        $this->infoCollection = $infoCollection;
        $this->filter = $filter;
    }

    /**
     * Delete the Attribute
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $isFilter = $this->getRequest()->getParam('filters');
        $ids = [];
        $message = "No account available to delete.";
        if (isset($id) && !empty($id)) {
            $ids[] = $id;
        } elseif (isset($isFilter)) {
            $collection = $this->filter->getCollection($this->infoCollection->create());
            $ids = $collection->getAllIds();
        }

        if (!empty($ids) && is_array($ids)) {
            $count = count($ids);
            /** @var $accounts */
            $info = $this->infoCollection->create()->addFieldToFilter('id', ['in' => $ids]);
            $info->walk('delete');
            $message = "{$count} Information(s) deleted successfully.";
        }

        $this->messageManager->addSuccessMessage($message);

        return $this->_redirect('form/index/index');
    }
}
