<?php

namespace Http\Queries;

use Exception;

class QueryBuilder
{
    public string $url = '';

    public array $params = [];

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        
        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }
}