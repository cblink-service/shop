<?php


namespace Cblink\Service\Shop\Meituan;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['meituan'] = function($app){
            return new Client($app);
        };
    }
}