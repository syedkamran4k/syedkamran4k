<?php
namespace Pws\Form\Model\ResourceModel\Info;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Pws\Form\Model\Info as Model;
use Pws\Form\Model\ResourceModel\Info as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
