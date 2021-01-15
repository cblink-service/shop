<?php

/*
 * This file is part of the cblink-service/shop.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Tests\Feature\Meituan;



use Cblink\Service\Kennel\Traits\ApiRequest;
use Cblink\Service\Shop\Application;
use Cblink\Service\Shop\Dispatch\Meituan\Client;
use PHPUnit\Framework\MockObject\Api;
use Tests\TestCase;

class MeituanShippingTeat extends \PHPUnit\Framework\TestCase
{
    protected $app;

    private $appId;

    private $shopId;

    protected function setUp(): void
    {
        $config = [
            'private' => true,
            'debug' => true,
            'base_url' => "",
            'app_id' => 0,
            'secret' => "",
            'key' => "",
            'meituan_uuid' => "",
        ];

        $fileName = __DIR__ . '/../../../BaseConfig.php';

        if (file_exists($fileName)){
            $config = include $fileName;
        }
        $this->appId = $config['uuid'];

        $this->shopId = $config['shop_id'];

        $this->app = new Application($config['config']);
    }

    /**
     * 查询配送服务
     */
    public function testList()
    {
        // 模拟类
        $client = \Mockery::mock($this->app->meituan);

        $client->expects()
            ->queryShippingList($this->appId, $this->shopId)
            ->andReturn([
                'err_code' => '0',
                'data' => [],
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request(sprintf('api/meituan/%s/%s/shippingList', $this->appId, $this->shopId))
            ->andReturn([
            'err_code' => '0',
            'data' => [],
        ]);

       $this->assertSame(
            $ApiClient->request(sprintf('api/meituan/%s/%s/shippingList', $this->appId,$this->shopId), $params),
            $client->queryShippingList($this->appId, $this->shopId)
        );
    }

    /**
     * 查询配送服务
     */
    public function testFetch()
    {
        // 参数
        $params = [
            'orderIds' => []
        ];

        // 模拟类
        $client = \Mockery::mock($this->app->meituan);

        $client->expects()
            ->queryShippingFetch($this->appId, $params)
            ->andReturn([
                'err_code' => '0',
                'data' => [],
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request(sprintf('api/meituan/%s/%s/shippingFetch', $this->appId,$this->shopId))
            ->andReturn([
                'err_code' => '0',
                'data' => [],
            ]);

        $this->assertSame(
            $ApiClient->request(sprintf('api/meituan/%s/%s/shippingFetch', $this->appId, $this->shopId)),
            $client->queryShippingFetch($this->appId, $this->shopId)
        );
    }
}