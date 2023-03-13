<?php

namespace Http\Client;

use Exception;

class ClientConfig
{
    private float $timeout = 10.00;

    private string $baseUrl = '';

    public function __construct(array $configs = array()){
        foreach($configs as $key => $config){
            if(property_exists($this, $key)){
                $this->{$key} = $config;
            }
        }
    }

    public function timeout(float $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function baseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getTimeout(): string
    {
        return $this->timeout;
    }
}