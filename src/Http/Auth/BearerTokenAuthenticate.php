<?php

namespace RequestManager\Http\Auth;

use RequestManager\Interfaces\IAuthInterface;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
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
