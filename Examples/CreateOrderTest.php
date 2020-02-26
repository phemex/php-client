<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../php-phemex-api.php';
require __DIR__ . '/../Configs/NormalConfigs.php';

// reload configs
//$pref_url   = \Phemex\Configs\NormalConfigs::ProdPrefUrl;
//$api_key    = \Phemex\Configs\NormalConfigs::ProdApiKey;
//$secret     = \Phemex\Configs\NormalConfigs::ProdSecret;

$pref_url   = \Phemex\Configs\NormalConfigs::TestnetPrefUrl;
$api_key    = \Phemex\Configs\NormalConfigs::TestnetApiKey;
$secret     = \Phemex\Configs\NormalConfigs::TestnetSecret;


$api = new \Phemex\Api($api_key, $secret, $pref_url);

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

// send reques
try {
    var_dump($api->createOrder($path, $body));
} catch (\Exception $e) {
    echo "Something error, code : {$e->getCode()}, message : {$e->getMessage()}";
}