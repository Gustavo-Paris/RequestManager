<?php

namespace RequestManager\Interfaces;

interface IAuthInterface
{
    /**
     * @param array $credentials
     * @return array
     */
    public function authenticate(array $credentials): array;
}
