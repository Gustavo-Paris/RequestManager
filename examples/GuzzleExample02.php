<?php

namespace RequestManager\Examples;

use RequestManager\HttpRequest;

/**
 * Template File Doc Comment
 *
 * PHP version 7.3
 *
 * @category Example
 * @package  GuzzleExample02.php
 * @author   Author <wesley.sartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class GuzzleExample02
{
    /**
     * @param string $uri
     * @param string $router
     * @param array $header
     * @return false|string
     */
    public function exampleRequest(
        string $uri,
        string $router,
        array  $header
    )
    {
        $return = (new HttpRequest())
            ->setHeader($header)
            ->setUri($uri)
            ->get('/' . $router);

        return json_encode($return);
    }
}
