<?php
namespace MyMod\Agent\Model\ResourceModel\Info;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MyMod\Agent\Model\Info as Model;
use MyMod\Agent\Model\ResourceModel\Info as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
