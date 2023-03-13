<?php

namespace Http\Client;

use Exception;

class Client
{
    private string $url;
    private string $method;

    const METHODS = [
        'PUT',
        'GET',
        'POST',
        'PATCH',
        'DELETE'
    ];

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function setMethod(string $method): self
    {
        if (!in_array($method, self::METHODS)) {
            throw new Exception('error');
        }

        $this->method = $method;

        return $this;
    }

    public function send(): mixed
    {
        if (!$this->url || !$this->method) {
            throw new Exception('error');
        }

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        if (!curl_errno($ch)) {
            $result = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            echo 'Code ', $result, "\n";
        }

        curl_close($ch);

        return $result;
    }
}