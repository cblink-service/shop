<?php

namespace Cblink\Service\Shop;

use Cblink\Service\Kennel\ServiceContainer;

/**
 * Class Application
 * @package Cblink\Service\Shop
 * @property-read Eleme\Client $eleme
 * @property-read Meituan\Client $meituan
 * @property-read App\Client $app
 * @property-read Dispatch\Meituan\Client $meituanDispatch
 */
class Application extends ServiceContainer
{

    /**
     * @return array
     */
    protected function getCustomProviders(): array
    {
        return [
            Meituan\ServiceProvider::class,
            Eleme\ServiceProvider::class,
            App\ServiceProvider::class,
            Dispatch\Meituan\ServiceProvider::class,
        ];
    }
}