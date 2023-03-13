<?php

use Http\Builders\RequestBuilder;
use Http\Queries\QueryBuilder;

class Curl
{
    private QueryBuilder $queryBuilder;
    private RequestBuilder $requestBuilder;

    public function __construct(QueryBuilder $queryBuilder, RequestBuilder $requestBuilder)
    {
        $this->queryBuilder = $queryBuilder;
        $this->requestBuilder = $requestBuilder;
    }

    public function send()
    {

    }
}