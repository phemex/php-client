<?php

namespace Phemex\Services;

use Curl\Curl;

class RequestService {

    /**
     * @param $pref_url
     * @param $path
     * @param $query
     * @param $body
     * @param $access_token
     * @param $secret_key
     * @return mixed
     * @throws \Exception
     */
    public static function postToPhemex($pref_url, $path, $query, $body, $access_token, $secret_key) {
        $expiry_now = time() + 60;
        $url = $pref_url.$path;
        $signature = self::sign($path, $query, $expiry_now, $body, $secret_key);

        $curl = new Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, 10);
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('x-phemex-access-token', $access_token);
        $curl->setHeader('x-phemex-request-expiry', $expiry_now);
        $curl->setHeader('x-phemex-request-signature', $signature);
        $curl->post($url, json_encode($body));
        $curl->close();

        if ($curl->error) {
            throw new \Exception($curl->response, $curl->error_code);
        }

        $json = json_decode($curl->response);

        if ($json->code != 0) {
            throw new \Exception($json->msg, $json->code);
        }

        return $json->data;
    }

    /**
     * @param $pref_url
     * @param $path
     * @param $query
     * @param $body
     * @param $access_token
     * @param $secret_key
     * @return mixed
     * @throws \Exception
     */
    public static function getToPhemex($pref_url, $path, $query, $body, $access_token, $secret_key) {
        $expiry_now = time() + 60;
        $url = $pref_url.$path;
        $signature = self::sign($path, $query, $expiry_now, $body, $secret_key);

        $curl = new Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, 10);
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('x-phemex-access-token', $access_token);
        $curl->setHeader('x-phemex-request-expiry', $expiry_now);
        $curl->setHeader('x-phemex-request-signature', $signature);
        $curl->get($url, $query);
        $curl->close();

        if ($curl->error) {
            throw new \Exception($curl->response, $curl->error_code);
        }

        $json = json_decode($curl->response);

        if ($json->code != 0) {
            throw new \Exception($json->msg, $json->code);
        }

        return $json->data;
    }


    /**
     * @param $path
     * @param $query
     * @param $expiry_now
     * @param $body
     * @param $secret_key
     * @return string
     */
    private static function sign($path, $query, $expiry_now, $body, $secret_key) {
        $data = '';
        $data .= $path;
        $data .= empty($query) ? '' : http_build_query($query);
        $data .= $expiry_now;
        $data .= empty($body) ? '' : json_encode($body);
        return hash_hmac('sha256', $data, $secret_key);
    }



}