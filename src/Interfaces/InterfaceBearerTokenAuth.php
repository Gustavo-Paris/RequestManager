<?php

namespace RequestManager\Interfaces;

use RequestManager\HttpRequestAdapter;

interface InterfaceBearerTokenAuth
{
    public function bearerTokenAuth(string $token): HttpRequestAdapter;
}
