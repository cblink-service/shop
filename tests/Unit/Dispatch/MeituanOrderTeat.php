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

class MeituanOrderTeat extends \PHPUnit\Framework\TestCase
{
    protected $dispatch;

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
            'uuid' => "1",
        ];

        $fileName = __DIR__ . '/../../../BaseConfig.php';

        if (file_exists($fileName)) {
            $config = include $fileName;
        }
        $this->appId = $config['uuid'];

        $this->dispatch = new Application($config);
    }

    /**
     * 查询配送服务
     */
    public function testCheck()
    {
        $lat = '22.5377174';
        $lng = '113.94006';

        // 参数
        $data = [
            'delivery_service_code' => '4011',
            'check_type' => 1,
            'mock_order_time' => time(),
            'shop_id' => 'test_0001',
            'receiver_address' => '广东省深圳市南山区粤海街道长虹科技大厦',
            'receiver_lng' => (int)($lng * pow(10, 6)),
            'receiver_lat' => (int)($lat * pow(10, 6)),
        ];

        // 模拟类
        $client = \Mockery::mock($this->dispatch->meituanDispatch);


        $client->expects()
            ->check($this->appId, $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [],
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request(sprintf('api/dispatch/meituan/%s/check', $this->appId), $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [],
            ]);

        $this->assertSame(
            $ApiClient->request(sprintf('api/dispatch/meituan/%s/check', $this->appId), $data),
            $client->check($this->appId, $data)
        );
    }

    /**
     * 查询骑手位置
     *
     * @throws \Cblink\ElemeDispatch\Exceptions\InvalidConfigException\
     */
    public function testLocation()
    {
        $data = [
            'delivery_id' => '',
            'mt_peisong_id' => '',  // 美团配送内部订单 id
        ];

        // 模拟类
        $client = \Mockery::mock($this->dispatch->meituanDispatch);


        $client->expects()
            ->location($this->appId, $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [
                    'lng' => 'example',
                    'lat' => 1
                ],
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request(sprintf('api/dispatch/meituan/%s/location', $this->appId), $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [
                    'lng' => 'example',
                    'lat' => 1
                ],
            ]);

        $this->assertSame(
            $ApiClient->request(sprintf('api/dispatch/meituan/%s/location', $this->appId), $data),
            $client->location($this->appId, $data)
        );
    }

    public function testCancel()
    {
        $data = [
            'mt_peisong_id' => '',
            'delivery_id' => '',
            'cancel_reason_id' => '',   // 取消原因类别，默认为接入方原因
            'cancel_reason' => '',  // 详细取消原因，最长不超过256个字符
        ];

        // 模拟类
        $client = \Mockery::mock($this->dispatch->meituanDispatch);


        $client->expects()
            ->cancelOrder($this->appId, $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [
                    'mt_peisong_id' => 'example',
                    'delivery_id' => 1000,
                    'order_id' => 'example'
                ],
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request(sprintf('api/dispatch/meituan/%s/cancel', $this->appId), $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [
                    'mt_peisong_id' => 'example',
                    'delivery_id' => 1000,
                    'order_id' => 'example'
                ],
            ]);

        $this->assertSame(
            $ApiClient->request(sprintf('api/dispatch/meituan/%s/cancel', $this->appId), $data),
            $client->cancelOrder($this->appId, $data)
        );
    }

    /**
     * 创建订单
     */
    public function testOrder()
    {
        $goods[] = [
            'goodCount' => 2,
            'goodName' => '测试商品',
        ];

        $data = [
            'delivery_id' => 1,
            'order_id' => 1,
            'poi_seq' => '40001', // 美团的流水号加4为前缀
            'shop_id' => 'test_0001',
            'delivery_service_code' => 4011,
            'receiver_name' => 'test',
            'receiver_address' => '中国',
            'receiver_phone' => '',
            'receiver_lng' => (int)(113.957613 * pow(10, 6)),
            'receiver_lat' => (int)(22.538135 * pow(10, 6)),
            'goods_value' => 100,
            'goods_weight' => 1,
            'goods_detail' => json_encode(['goods' => $goods]),
        ];


        // 模拟类
        $client = \Mockery::mock($this->dispatch->meituanDispatch);


        $client->expects()
            ->createByShop($this->appId, $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [
                    'mt_peisong_id' => 'example',
                    'delivery_id' => 1000,
                    'order_id' => 'example'
                ],
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request(sprintf('api/dispatch/meituan/%s/createByShop', $this->appId), $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [
                    'mt_peisong_id' => 'example',
                    'delivery_id' => 1000,
                    'order_id' => 'example'
                ],
            ]);

        $this->assertSame(
            $ApiClient->request(sprintf('api/dispatch/meituan/%s/createByShop', $this->appId), $data),
            $client->createByShop($this->appId, $data)
        );

    }

    /**
     * 预订单
     */
    public function testPreCreateOrderByShop()
    {
        $goods[] = [
            'goodCount' => 2,
            'goodName' => '测试商品',
        ];

        $data = [
            'delivery_id' => 1,
            'order_id' => 1,
            'poi_seq' => '40001', // 美团的流水号加4为前缀
            'shop_id' => 'test_0001',
            'delivery_service_code' => 4011,
            'receiver_name' => 'test',
            'receiver_address' => '中国',
            'receiver_phone' => '',
            'receiver_lng' => (int)(113.957613 * pow(10, 6)),
            'receiver_lat' => (int)(22.538135 * pow(10, 6)),
            'goods_value' => 100,
            'goods_weight' => 1,
            'goods_detail' => json_encode(['goods' => $goods]),
            'pay_type_code' => 0
        ];
        // 模拟类
        $client = \Mockery::mock($this->dispatch->meituanDispatch);

        $client->expects()
            ->preCreateOrderByShop($this->appId, $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [
                    'delivery_distance'=> 'example',
                    'delivery_fee'=> 1000,
                ],
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request(sprintf('api/dispatch/meituan/%s/preCreateOrderByShop', $this->appId), $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [
                    'delivery_distance'=> 'example',
                    'delivery_fee'=> 1000,
                ],
            ]);

        $this->assertSame(
            $ApiClient->request(sprintf('api/dispatch/meituan/%s/preCreateOrderByShop', $this->appId), $data),
            $client->preCreateOrderByShop($this->appId, $data)
        );

    }

    public function testOrderStatus()
    {
        $data = [
            'delivery_id' => '',
            'mt_peisong_id' => '',  // 美团配送内部订单 id
        ];
        // 模拟类
        $client = \Mockery::mock($this->dispatch->meituanDispatch);

        $client->expects()
            ->orderStatus($this->appId, $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [
                    "cancel_reason" => "",
                    "cancel_reason_id" => 0,
                    "coupons_amount" => 0,
                    "courier_name" => "",
                    "courier_phone" => "",
                    "delivery_distance" => 1,
                    "delivery_fee" => 0.02,
                    "delivery_id" => "13",
                    "mt_peisong_id" => "1634202466570001841",
                    "operate_time" => 1634202466,
                    "order_id" => "13",
                    "pay_amount" => 0.02,
                    "settlement_mode_code" => 2,
                    "status" => 0
                ],
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request(sprintf('api/dispatch/meituan/%s/orderStatus', $this->appId), $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [
                    "cancel_reason" => "",
                    "cancel_reason_id" => 0,
                    "coupons_amount" => 0,
                    "courier_name" => "",
                    "courier_phone" => "",
                    "delivery_distance" => 1,
                    "delivery_fee" => 0.02,
                    "delivery_id" => "13",
                    "mt_peisong_id" => "1634202466570001841",
                    "operate_time" => 1634202466,
                    "order_id" => "13",
                    "pay_amount" => 0.02,
                    "settlement_mode_code" => 2,
                    "status" => 0
                ],
            ]);

        $this->assertSame(
            $ApiClient->request(sprintf('api/dispatch/meituan/%s/orderStatus', $this->appId), $data),
            $client->orderStatus($this->appId, $data)
        );
    }
}