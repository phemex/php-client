<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../php-phemex-api.php';
require __DIR__ . '/../Configs/NormalConfigs.php';


// reload config
//$pref_url   = \Phemex\Configs\NormalConfigs::ProdPrefUrl;
//$api_key    = \Phemex\Configs\NormalConfigs::ProdApiKey;
//$secret     = \Phemex\Configs\NormalConfigs::ProdSecret;

$pref_url   = \Phemex\Configs\NormalConfigs::TestnetPrefUrl;
$api_key    = \Phemex\Configs\NormalConfigs::TestnetApiKey;
$secret     = \Phemex\Configs\NormalConfigs::TestnetSecret;


$api = new \Phemex\Api($api_key, $secret, $pref_url);

$path = '/exchange/wallets/withdrawList';
$query = [
    'currency' => 'BTC',
    'limit' => 10,
    'offset' => 0
];

// send request
try {
    var_dump($api->withdrawList($path, $query));
} catch (\Exception $e) {
    echo "Something error, code : {$e->getCode()}, message : {$e->getMessage()}";
}