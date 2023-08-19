<?php

namespace RequestManager\Interfaces;

interface IBearerTokenAuthenticate
{
    /**
     * @param array $credentials
     * @return array
     */
    public function bearerTokenAuthenticate(array $credentials): array;
}
