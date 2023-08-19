<?php

namespace RequestManager\Examples;

use RequestManager\HttpRequestAdapter;

/**
 * Template File Doc Comment
 *
 * PHP version 7.3
 *
 * @category Example
 * @package  GuzzleExample01.php
 * @author   Author <wesley.sartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class GuzzleExample01
{
    /**
     * @param string $uri
     * @param string $router
     * @param string $username
     * @param string $password
     * @param array $header
     * @return false|string
     */
    public function exampleRequest(
        string $uri,
        string $router,
        string $username,
        string $password,
        array $header
    ) {
        $return = (new HttpRequestAdapter())
            ->basicAuth($username, $password)
            ->setHeader($header)
            ->setUri($uri)
            ->get('/' . $router);

        return json_encode($return);
    }
}
