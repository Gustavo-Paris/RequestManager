<?php

namespace RequestManager\Requests;

use RequestManager\Interfaces\RequestClient;

class GuzzleRequest implements RequestClient
{
    public function setAuth(string $auth): void
    {
        // TODO: Implement setAuth() method.
    }

    public function setUri(string $uri): void
    {
        // TODO: Implement setUri() method.
    }

    public function setHeader(array $header): void
    {
        // TODO: Implement setHeader() method.
    }

    public function setData(array $data): void
    {
        // TODO: Implement setData() method.
    }

    public function request(string $method): array
    {
        // TODO: Implement request() method.
        return [];
    }
}