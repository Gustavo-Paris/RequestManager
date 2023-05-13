<?php

namespace RequestManager\Interfaces;

use RequestManager\HttpRequestAdapter;

interface InterfaceBasicAuth
{
    public function basicAuth(string $username, string $password): HttpRequestAdapter;
}
