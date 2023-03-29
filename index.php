<?php

use Http\Client\ClientConfig;
use Http\Client\Enums\RequestType;

require_once __DIR__ . '/vendor/autoload.php';

$config = (new ClientConfig())->baseUrl('test')->timeout(1000);

$client = new \Http\Client\Client($config);


var_dump('1');
$request = $client->request(RequestType::PUT, 'https://fakestoreapi.com/products/21', [
    'title' => 'test product',
    'price' => 55,
    'description' => 'lorem ipsum set',
    'image' => 'https://i.pravatar.cc',
    'category' => 'electronic'
])->send();
var_dump('3');

dd($request->content());