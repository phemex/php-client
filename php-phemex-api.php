<?php

namespace Phemex;

// PHP version check

require __DIR__ . '/Services/RequestService.php';

if (version_compare(phpversion(), '7.0', '<=')) {
    fwrite(STDERR, "Hi, PHP " . phpversion() . " support will be removed very soon as part of continued development.\n");
    fwrite(STDERR, "Please consider upgrading.\n");
}

/**
 * Main Phemex class
 *
 * Eg. Usage:
 * $api = new Phemex\\API();
 */

class Api {

    protected $api_key;
    protected $secret;
    protected $pref_url;

    public function __construct($api_key, $secret, $pref_url)
    {
        $this->api_key      = $api_key;
        $this->secret       = $secret;
        $this->pref_url     = $pref_url;
    }

    /**\
     * @param $path
     * @param $body
     * @throws \Exception
     */
    public function createOrder($path, $body) {
        return \Phemex\Services\RequestService::postToPhemex($this->pref_url, $path, null, $body, $this->api_key, $this->secret);
    }

    /**
     * @param $path
     * @param $query
     * @return mixed
     * @throws \Exception
     */
    public function withdrawList($path, $query) {
        return \Phemex\Services\RequestService::getToPhemex($this->pref_url, $path, $query, null, $this->api_key, $this->secret);
    }


}

