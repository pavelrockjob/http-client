<?php

require_once __DIR__ . '/vendor/autoload.php';

$client = new \Http\Client\Client();
$response = $client->setUrl('https://fakestoreapi.com/products')->setMethod('GET')->send();

dd($response->headers());
//var_dump($response->code());
//var_dump($response->content());