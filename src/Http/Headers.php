<?php

namespace RequestManager\Http;

class Headers
{
    /**
     * @var array
     */
    private $headers =  ['Content-type' => 'application/json'];

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }
}
