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

// 应用管理
$app->app;

// state参数最终会在授权跳转页面去返回
$app->eleme->getAuthUrl('xxxx', 'state', '跳转地址');
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/cblink-service/shop/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/cblink-service/shop/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT