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

    /**
     * 查询门店的评价列表
     *
     * @param string $appId
     * @param string $shopId
     * @param array $params
     * @return mixed
     */
    public function queryShopCommentList(string $appId, string $shopId, array $params)
    {
        return $this->get(sprintf('api/meituan/%s/%s/comment/list', $appId, $shopId), $params);
    }

    /**
     * 添加门店评论的回复
     *
     * @param string $appId
     * @param string $shopId
     * @param array $params
     * @return mixed
     */
    public function addCommentReply(string $appId, string $shopId, array $params)
    {
        return $this->post(sprintf('api/meituan/%s/%s/comment/add-reply', $appId, $shopId), $params);
    }

    /**
     * @param string $appId
     * @param string $shopId
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function queryShopScore(string $appId, string $shopId)
    {
        return $this->get(sprintf('api/meituan/%s/%s/score', $appId, $shopId));
    }
}