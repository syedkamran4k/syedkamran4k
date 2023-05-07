<?php

namespace MyMod\Agent2\Helper;

use Magento\Framework\App\Helper\Context;

class ProxyCalledHelper extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @param string $action
     * @return array
     */
    public function ProxyCalculation()
    {
      Print('in called class');
        die('<-ProxyCalculation-');
    }
}
