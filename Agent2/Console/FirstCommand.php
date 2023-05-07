<?php

namespace MyMod\Agent2\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FirstCommand extends Command
{

    const NAME = 'name';

    protected $ProxyCalledHelper ;

    public function __construct(
        \MyMod\Agent2\Helper\ProxyCalledHelper $ProxyCalledHelper,
        string $name = null
    ) {
        $this->_ProxyCalledHelper = $ProxyCalledHelper;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('mymod:agent2:showresult');
        $this->setDescription('MyMod');

        parent::configure();
    }
    protected function execute(InputInterface $input , OutputInterface $output)
    {
        $action = 1 ;
        if ($action == 1) {
            $this->_ProxyCalledHelper->ProxyCalculation();
        } else {
            print_r('proxy not called ') ; die('<--end');
        }
    }
}
