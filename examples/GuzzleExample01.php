<?php

namespace RequestManager\Examples;

use RequestManager\Http\HttpAdapter;
use RequestManager\Http\HttpConstants;

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
     * @param array $auth
     * @param array $header
     * @param array $data example to multipart data {'qtype' => 'param','query' => '0','oper' => '>',
        'page' => '1','rp' => '20','sortname' => 'param','sortorder' => 'asc'}
     * @return mixed
     */
    public function exampleRequest(
        string $uri,
        string $router,
        array $auth,
        array $header,
        array $data
    ) {
            $httpAdapter = new HttpAdapter();
            $httpAdapter
                ->getClient()
                ->setAuth([$auth['username'],$auth['password']], $auth['type'])
                ->setHeader($header)
                ->setUri($uri);

            return $httpAdapter
                ->getClient()
                ->setData($data, HttpConstants::BODY_TYPE_MULTIPART)
                ->post($router);
    }
}
