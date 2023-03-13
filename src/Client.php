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

    /**
     * @throws Exception
     */
    public function send(): ClientResponse
    {
        if (!$this->url || !$this->method) {
            throw new Exception('error');
        }

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$headers) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2)
                    return $len;

                $headers[strtolower(trim($header[0]))] = trim($header[1]);

                return $len;
            }
        );

        $result = $content = curl_exec($ch);

        if (!curl_errno($ch)) {
            $result = curl_getinfo($ch);
        }

        curl_close($ch);

        return (new ClientResponse($result, $content, $headers));
    }
}