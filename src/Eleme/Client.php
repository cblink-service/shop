<?php

namespace Cblink\Service\Shop\Eleme;

use Cblink\Service\Kennel\AbstractApi;

/**
 * Class Client
 * @package Cblink\Service\Shop\Eleme
 */
class Client extends AbstractApi
{
    /**
     * 获取饿了么授权链接
     *
     * @param $appId
     * @param $state
     * @param $redirectUrl
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function getAuthUrl($appId, $redirectUrl, $state)
    {
        return $this->get(sprintf('api/eleme/%s/authorize-url', $appId), [
            'redirect_url' => $redirectUrl,
            'state' => $state,
        ]);
    }
}