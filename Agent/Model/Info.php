<?php

namespace MyMod\Agent\Model;

use Magento\Framework\Model\AbstractModel;
use MyMod\Agent\Model\ResourceModel\Info as ResourceModel;

class Info extends AbstractModel
{
    const COLUMN_ID = 'id';
    const COLUMN_FIRST_NAME = 'first_name';
    const COLUMN_LAST_NAME = 'last_name';
    const COLUMN_EMAIL = 'email';
    const COLUMN_PHONE = 'phone';
    const COLUMN_AGENT_IMAGE = 'agent_image';

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
