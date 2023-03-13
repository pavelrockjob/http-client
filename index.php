<?php

require_once __DIR__ . '/vendor/autoload.php';

$client = new \Http\Client\Client();
/**
 * @var CurlHandle $response;
 */
$response = $client->setUrl('sdgsdhs')->setMethod('GET')->send();
//var_dump($response);