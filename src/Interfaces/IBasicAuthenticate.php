<?php

namespace RequestManager\Interfaces;

interface IBasicAuthenticate
{
    /**
     * @param array $credentials
     * @return array
     */
    public function basicAuthenticate(array $credentials): array;
}
