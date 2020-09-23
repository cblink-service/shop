<?php

namespace Cblink\Service\Shop;

use Cblink\Service\Kennel\ServiceContainer;

/**
 * Class Application
 * @package Cblink\Service\Shop
 * @property-read Eleme\Client $eleme
 * @property-read Meituan\Client $meituan
 * @property-read App\Client $app
 */
class Application extends ServiceContainer
{

    /**
     * @return array
     */
    protected function getCustomProviders(): array
    {
        return [
            Eleme\ServiceProvider::class,
            App\ServiceProvider::class,
        ];
    }
}