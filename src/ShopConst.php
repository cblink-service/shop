<?php


namespace Cblink\Service\Shop;


class ShopConst
{

   const TYPE_ELEME  = 'eleme';
   const TYPE_MEITUAN = 'meituan';


    const EVENT_SHOP_AUTH = 'shop.auth';
    const EVENT_SHOP_CANCEL = 'shop.auth.cancel';
    const EVENT_ORDER_CREATE = 'order.create';
    const EVENT_ORDER_STATUS_UPDATE = 'order.status.update';


    const STATUS_CREATE = 1;
    const STATUS_COMPLETE = 2;
    const STATUS_CANCEL = 10;
    const STATUS_REFUNDED = 20;
}