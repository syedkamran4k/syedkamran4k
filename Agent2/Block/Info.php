<?php

namespace MyMod\Agent2\Block;

use Magento\Framework\View\Element\Template;

class Info extends Template
{
    /** @var \Magento\Store\Model\StoreManagerInterface */
    public $storeManager;

    /** @var \MyMod\Agent2\Model\ResourceModel\Info\CollectionFactory */
    public $infoCollectionFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \MyMod\Agent2\Model\ResourceModel\Info\CollectionFactory $infoCollectionFactory,
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->infoCollectionFactory = $infoCollectionFactory;
        parent::__construct($context, $data);

    }

    public function getInfo()
    {
        $infoCollection = $this->infoCollectionFactory->create();
        $infoData = $infoCollection->getData();
        return $infoData;
    }

    public function getDeleteUrl()
    {
        return '*/*/delete';
    }

}
