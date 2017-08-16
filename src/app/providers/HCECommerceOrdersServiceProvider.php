<?php

namespace interactivesolutions\honeycombecommerceorders\app\providers;

use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCECommerceOrdersServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombecommerceorders\app\http\controllers';

    public $serviceProviderNameSpace = 'HCECommerceOrders';
}





