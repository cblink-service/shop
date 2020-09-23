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
        return $this->get(sprintf('api/meituan/%s/authorize-url', $appId), [
            'businessId' => $businessId,
            'shop_id' => $shopId,
        ]);
    }
}