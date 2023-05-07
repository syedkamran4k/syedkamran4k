<?php

namespace Pws\Form\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Info extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('pws_form_info', 'id');
    }
}
