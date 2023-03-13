<?php

namespace Http\Builders;

use Exception;

class RequestBuilder
{
    public array $headers = [];

    public string $method = '';

    const METHODS = [
        'PUT',
        'GET',
        'POST',
        'PATCH',
        'DELETE'
    ];

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function setMethod(string $method): self
    {
        if(!in_array($method, self::METHODS)){
            throw new Exception('error');
        }

        $this->method = $method;

        return $this;
    }
}