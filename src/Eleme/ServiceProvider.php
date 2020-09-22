<?php


namespace Cblink\Service\Shop\Eleme;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['eleme'] = function($app){
            return new Client($app);
        };
    }
}