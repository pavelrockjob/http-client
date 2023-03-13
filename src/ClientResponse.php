<?php

namespace Http\Client;

class ClientResponse
{
    private array $result;
    private string $content;
    private array $headers;

    public function __construct(array $result, string $content, array $headers)
    {
        $this->result = $result;
        $this->content = $content;
        $this->headers = $headers;
    }

    public function code(): int {
        return $this->result['http_code'];
    }

    public function content(): ?string {
        return $this->content;
    }

    public function headers(): array {
        return $this->headers;
    }


}