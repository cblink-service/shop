<?php

namespace Cblink\Service\Shop\Meituan;

use Cblink\Service\Kennel\AbstractApi;

class Client extends AbstractApi
{

    /**
     * 获取美团授权链接
     *
     * @param $appId
     * @param $businessId
     * @param $shopId
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function getAuthUrl($appId, $businessId, $shopId)
    {
        return $this->post(sprintf('api/meituan/%s/authorize-url', $appId), [
            'business_id' => $businessId,
            'shop_id' => $shopId,
        ]);
    }

    /**
     * 获取美团取消授权链接
     *
     * @param $appId
     * @param $businessId
     * @param $shopId
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function cancelAuthUrl($appId, $businessId, $shopId)
    {
        return $this->post(sprintf('api/meituan/%s/cancel-authorize-url', $appId), [
            'business_id' => $businessId,
            'shop_id' => $shopId,
        ]);
    }
}