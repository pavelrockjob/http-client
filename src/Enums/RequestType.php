<?php

namespace Http\Client\Enums;

enum RequestType: string
{
    case POST = 'POST';
    case GET = 'GET';
    case DELETE = 'DELETE';
    case PUT = 'PUT';
    case PATCH = 'PATCH';
}