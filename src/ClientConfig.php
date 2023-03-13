<?php

namespace Http\Client;

use Exception;

class ClientConfig
{
    private float $timeout = 10.00;

    private string $baseUrl = '';

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

    public function getConfig(): array
    {
        return [
            'timeout' => $this->timeout,
            'baseUrl' => $this->baseUrl,
        ];
    }
}