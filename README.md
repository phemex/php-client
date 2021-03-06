# php-client
Phemex PHP Client SDK

Prepare

```
1.Clone the code locally
2.Replace your ProdApiKey and ProdSecret in "your project/Configs/NormalConfigs.php"
```


Getting started

```php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../php-phemex-api.php';
require __DIR__ . '/../Configs/NormalConfigs.php';
```
```php
// reload configs
$pref_url   = \Phemex\Configs\NormalConfigs::ProdPrefUrl;
$api_key    = \Phemex\Configs\NormalConfigs::ProdApiKey;
$secret     = \Phemex\Configs\NormalConfigs::ProdSecret;
```
```php
// create new Phemex API
$api = new \Phemex\Api($api_key, $secret, $pref_url);
```
```php
// stitching parameters
$path = '/orders';
$body = [
    'actionBy'      => 'FromOrderPlacement',
    'symbol'        => 'ETHUSD',
    'clOrdID'       => \Ramsey\Uuid\Uuid::uuid4(),
    'side'          => 'Buy',
    'priceEp'       => 2581000,
    'orderQty'      => 100,
    'ordType'       => 'Market',
    'reduceOnly'    => false,
    'triggerType'   => 'UNSPECIFIED',
    'pegPriceType'  => 'UNSPECIFIED',
    'timeInForce'   => 'ImmediateOrCancel',
    'takeProfitEp'  => 0,
    'stopLossEp'    => 0
];
```
```php
// send request and echo the results, or catch the exceptions
try {
    var_dump($api->createOrder($path, $body));
} catch (\Exception $e) {
    echo "Something error, code : {$e->getCode()}, message : {$e->getMessage()}";
}
```

