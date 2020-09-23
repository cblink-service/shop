<h1 align="center"> shop </h1>

<p align="center"> .</p>


## Installing

```shell
$ composer require cblink-service/shop -vvv
```

## Usage

```php
<?php
$config = [
    'private' => true,
    'debug' => true,
    'base_url' => 'https://127.0.0.1',
    'app_id' => 1234,
    'key' => 'xxxxx',
    'secret' => 'xxxxxxxxx',
];

$app = new Cblink\Service\Shop\Application($config);

// 创建饿了么应用
$app->app->create([
    'name' => '应用名称',
    'type' => \Cblink\Service\Shop\ShopConst::TYPE_ELEME,
    'config' => [
        'app_id' => 'xxxx',
        'secret' => 'xxxx',
        'debug' => true,
    ]
]);

// 创建美团应用
$app->app->create([
    'name' => '应用名称',
    'type' => \Cblink\Service\Shop\ShopConst::TYPE_MEITUAN,
    'config' => [
        'developer_id' => 'xxxx',
        'sign' => 'xxxx',
    ]
]);

// 查询应用下的通知地址
$app->app->notifies('应用id');

// 保存或修改通知地址
$app->app->createNotify('应用id', \Cblink\Service\Shop\ShopConst::EVENT_ORDER_CREATE, 'https://www.baodu.com');

// state参数最终会在授权跳转页面去返回
$app->eleme->getAuthUrl('xxxx', '授权成功的跳转地址', 'state');

// 美团
$app->meituan->getAuthUrl('xxxx', '授权成功的跳转地址', 'state');
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/cblink-service/shop/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/cblink-service/shop/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT