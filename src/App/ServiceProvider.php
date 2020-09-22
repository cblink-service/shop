<?php


namespace Cblink\Service\Shop\App;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['app'] = function ($app){
            return new Client($app);
        };
    }
}