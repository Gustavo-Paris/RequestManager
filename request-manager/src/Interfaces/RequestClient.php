<?php

namespace RequestManager\Interfaces;

interface RequestClient
{
    public function setAuth(string $auth): void;

    public function setUri(string $uri): void;

    public function setHeader(array $header): void;

    public function setData(array $data): void;

    public function request(string $method): array;

}