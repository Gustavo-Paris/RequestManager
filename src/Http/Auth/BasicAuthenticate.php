<?php

namespace RequestManager\Http\Auth;

use IxcRequest\Interfaces\IAuthInterface;
use IxcRequest\Interfaces\IBasicAuthenticate;

class BasicAuthenticate implements IAuthInterface
{
    /**
     * @param array $credentials
     * @return array[]
     */
    public function authenticate(array $credentials): array
    {
        return [
            'auth' => [
                $credentials['username'],
                $credentials['password'],
            ]
        ];
    }
}
