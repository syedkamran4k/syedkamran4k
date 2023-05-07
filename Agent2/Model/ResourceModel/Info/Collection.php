<?php
namespace MyMod\Agent2\Model\ResourceModel\Info;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MyMod\Agent2\Model\Info as Model;
use MyMod\Agent2\Model\ResourceModel\Info as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
