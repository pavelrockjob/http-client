<?php

use Http\Client\ClientConfig;

require_once __DIR__ . '/vendor/autoload.php';

$config = (new ClientConfig())->baseUrl('test')->timeout(3.00);

$client = new \Http\Client\Client($config);
$response = $client->setUrl('https://fakestoreapi.com/products')
//    ->setQuery(['limit' => 1])
    ->setBody([
        'title' => 'test product',
        'price' => 14,
                    'description' => 'lorem ipsum set',
                    'image' => 'https://i.pravatar.cc',
                    'category' => 'electronic'
    ])
    ->setMethod('POST')
    ->send();

var_dump($response->code());
dd(json_decode($response->content(), true));
//var_dump($response->code());
//var_dump($response->content());