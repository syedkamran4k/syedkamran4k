<?php

namespace Pws\Form\Model;

use Magento\Framework\Model\AbstractModel;
use Pws\Form\Model\ResourceModel\Info as ResourceModel;

class Info extends AbstractModel
{
    const COLUMN_ID = 'id';
    const COLUMN_FIRST_NAME = 'first_name';
    const COLUMN_LAST_NAME = 'last_name';
    const COLUMN_ADDRESS = 'address';
    const COLUMN_DESCRIPTION = 'description';
    const COLUMN_PHONE = 'phone';
//    const COLUMN_AGENT_IMAGE = 'form_image';

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
