<?php

namespace MyMod\Agent\Block;

use Magento\Framework\View\Element\Template;

class Info extends Template
{
    /** @var \Magento\Store\Model\StoreManagerInterface */
    public $storeManager;

    /** @var \MyMod\Agent\Model\ResourceModel\Info\CollectionFactory */
    public $infoCollectionFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \MyMod\Agent\Model\ResourceModel\Info\CollectionFactory $infoCollectionFactory,
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
