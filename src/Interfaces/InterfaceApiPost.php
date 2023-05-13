<?php

namespace RequestManager\Interfaces;

interface InterfaceApiPost
{
    public function post(string $route = ''): array;
}
