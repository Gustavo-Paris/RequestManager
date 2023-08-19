<?php

namespace RequestManager\Interfaces;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
interface IBearerTokenAuthenticate
{
    /**
     * @param array $credentials
     * @return array
     */
    public function bearerTokenAuthenticate(array $credentials): array;
}
