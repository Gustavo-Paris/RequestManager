<?php

namespace RequestManager\examples;

use RequestManager\Interfaces\RequestClient;
use RequestManager\HttpRequest;

/**
 * Template File Doc Comment
 *
 * PHP version 7.3
 *
 * @category Example of request
 * @package  PhpCurlClassRequestExample01.php
 * @author   Author <wesley.sartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class PhpCurlClassRequestExample01
{
    /**
     * @param RequestClient $requestClient
     * @param string $uri
     * @param string $router
     * @param string $username
     * @param string $password
     * @param array $header
     * @return array
     */
    public function exampleRequest(
        RequestClient $requestClient,
        string        $uri,
        string        $router,
        string        $username,
        string        $password,
        array         $header
    ): array
    {
        return (new HttpRequest())
            ->setClient($requestClient)
            ->basicAuth($username, $password)
            ->setHeader($header)
            ->setUri($uri)
            ->get('/' . $router);
    }
}
