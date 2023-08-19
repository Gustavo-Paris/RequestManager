<?php

namespace RequestManager\Http\Auth;

use IXCRequest\Interfaces\IAuthInterface;

class BearerTokenAuthenticate implements IAuthInterface
{
    /**
     * @param array $credentials
     * @return string[]
     */
    public function authenticate(array $credentials): array
    {
        return [
            'Authorization' => 'Bearer ' . $credentials['token'],
            'Accept'        => 'application/json',
        ];
    }
}
