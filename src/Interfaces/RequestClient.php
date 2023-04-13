<?php

namespace RequestManager\Interfaces;

interface RequestClient
{
    public function setAuth(array $auth): void;

    public function setUri(string $uri): void;

    public function setHeader(array $header): array;

    public function setData(array $data): void;

    public function request(string $method): mixed;
}
