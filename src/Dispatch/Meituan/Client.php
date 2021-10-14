<?php

/*
 * This file is part of the cblink-service/shop.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\Service\Shop\Dispatch\Meituan;

use Cblink\Service\Kennel\AbstractApi;

class Client extends AbstractApi
{

    /**
     * 验证配送能力
     *
     * @param $appId
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function check($appId, array $params)
    {
        return $this->post(sprintf('api/dispatch/meituan/%s/check', $appId), $params);
    }

    /**
     * 骑手位置
     *
     * @param $appId
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function location($appId, array $params)
    {
        return $this->post(sprintf('api/dispatch/meituan/%s/location', $appId), $params);
    }

    /**
     * 创建订单
     *
     * @param $appId
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function createByShop($appId, array $params)
    {
        return $this->post(sprintf('api/dispatch/meituan/%s/createByShop', $appId), $params);
    }

    /**
     * 取消订单
     *
     * @param $appId
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function cancelOrder($appId, array $params)
    {
        return $this->post(sprintf('api/dispatch/meituan/%s/cancel', $appId), $params);
    }

    /**
     * 预下单
     *
     * @param $appId
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function preCreateOrderByShop($appId, array $params)
    {
        return $this->post(sprintf('api/dispatch/meituan/%s/preCreateOrderByShop', $appId), $params);
    }

    /**
     * 配送单详情
     *
     * @param $appId
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function orderStatus($appId, array $params)
    {
        return $this->post(sprintf('api/dispatch/meituan/%s/orderStatus', $appId), $params);
    }
}