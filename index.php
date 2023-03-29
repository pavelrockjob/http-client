<?php

use Http\Client\ClientConfig;
use Http\Client\Enums\RequestType;

require_once __DIR__ . '/vendor/autoload.php';

$config = (new ClientConfig())->baseUrl('test')->timeout(10);

$client = new \Http\Client\Client($config);


$request = $client->request(RequestType::PUT, 'https://fakestoreapi.com/products/21', [
    'title' => 'test product',
    'price' => 55,
    'description' => 'lorem ipsum set',
    'image' => 'https://i.pravatar.cc',
    'category' => 'electronic'
])->send();

dd($request->content());