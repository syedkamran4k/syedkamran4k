<?php

namespace MyMod\Agent2\Helper;

use Magento\Framework\App\Helper\Context;

class Proxytest extends \Magento\Framework\App\Helper\AbstractHelper
{

    protected $ProxyCalledHelper ;

    public function __construct(
        Context $context,
        \MyMod\Agent2\Helper\ProxyCalledHelper $ProxyCalledHelper
    ) {
        parent::__construct($context);
        $this->_ProxyCalledHelper = $ProxyCalledHelper;
    }


    /**
     * @param string $action
     * @return array
     */
    public function Proxycondition()
    {
        $action = 1 ;
        if ($action == 1) {
            $this->_ProxyCalledHelper->ProxyCalculation();
        } else {
            print_r('proxy not called ') ; die('<--end');
        }
    }
}
