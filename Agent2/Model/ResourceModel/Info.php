<?php

namespace MyMod\Agent2\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Info extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('mymod_agent_info2', 'id');
    }
}
