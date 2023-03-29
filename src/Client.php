<?php

namespace Http\Client;

use Exception;
use Http\Client\Enums\RequestType;

class Client
{
    private string $url;

    private RequestType $method;

    private string $query = '';

    private array $body = [];

    private ClientConfig $clientConfig;

    public function __construct(ClientConfig $clientConfig){
        $this->clientConfig = $clientConfig;
    }

    /**
     * @param RequestType $method
     * @param string $url
     * @param array $params
     * @return $this
     * @throws Exception
     */
    public function request(RequestType $method, string $url, array $params): self
    {
        $this->setBody($params);

        $method === RequestType::GET
            ? $this->setQuery($params)
            : $this->setBody($params);

        $this->setMethod($method);
        $this->setUrl($url);

        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function setMethod(RequestType $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function setQuery(array $params): self
    {
        $this->query = http_build_query($params);

        return $this;
    }

    /**
     * @throws Exception
     */
    public function setBody(array $params): self
    {
        if (isset($this->method) && $this->method === RequestType::GET) {
            throw new Exception('error');
        }

        $this->body = $params;

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

        $ch = curl_init(!empty($this->query) ? join('?', [$this->url, $this->query]) : $this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method->value);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->body) );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->body) );
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $this->clientConfig->getTimeout());
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

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
        } else {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        return (new ClientResponse($result, $content, $headers));
    }
}