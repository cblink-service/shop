<?php

/*
 * This file is part of the cblink-service/shop.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Tests\Feature\Dispatch;



use Cblink\Service\Kennel\Traits\ApiRequest;
use Cblink\Service\Shop\Application;
use Cblink\Service\Shop\Dispatch\Meituan\Client;
use PHPUnit\Framework\MockObject\Api;
use Tests\TestCase;

class ElemeOrderTeat extends \PHPUnit\Framework\TestCase
{
    protected $app;

    private $appId;

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

        $this->app = new Application($config['config']);
    }

    /**
     * 查询配送服务
     */
    public function testOrderComment()
    {
        // 参数
        $params = [
            'startTime' => '2020-11-17T00:00:00',
            'endTime' => '2020-11-18T15:00:00',
            'offset' => '0',
            'pageSize' => '10',
            'shopId' => '2056455',
        ];

        // 模拟类
        $client = \Mockery::mock($this->app->eleme);

        $client->expects()
            ->queryShopOrderCommentList($this->appId, $params)
            ->andReturn([
                'err_code' => '0',
                'data' => [],
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request(sprintf('api/eleme/%s/orderComment/list', $this->appId), $params)
            ->andReturn([
            'err_code' => '0',
            'data' => [],
        ]);

       $this->assertSame(
            $ApiClient->request(sprintf('api/eleme/%s/orderComment/list', $this->appId), $params),
            $client->queryShopOrderCommentList($this->appId, $params)
        );
    }

    /**
     * 查询配送服务
     */
    public function testOrderIdsComment()
    {
        // 参数
        $params = [
            'orderIds' => []
        ];

        // 模拟类
        $client = \Mockery::mock($this->app->eleme);

        $client->expects()
            ->queryOrderRatesByOrderIds($this->appId, $params)
            ->andReturn([
                'err_code' => '0',
                'data' => [],
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request(sprintf('api/eleme/%s/orderCommentByOrderIds/list', $this->appId), $params)
            ->andReturn([
                'err_code' => '0',
                'data' => [],
            ]);

        $this->assertSame(
            $ApiClient->request(sprintf('api/eleme/%s/orderCommentByOrderIds/list', $this->appId), $params),
            $client->queryOrderRatesByOrderIds($this->appId, $params)
        );
    }
}