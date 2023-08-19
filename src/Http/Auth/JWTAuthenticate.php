<?php

namespace RequestManager\Http\Auth;

use IXCRequest\Interfaces\IAuthInterface;

class JWTAuthenticate implements IAuthInterface
{
    public function authenticate(array $credencials): array
    {
        return [
            'auth' => [
                $credencials['username'],
                $credencials['password'],
            ]
        ];
    }
}
