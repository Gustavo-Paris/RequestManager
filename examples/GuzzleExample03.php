<?php

namespace RequestManager\Examples;

use RequestManager\HttpRequestAdapter;
use RequestManager\Interfaces\RequestClient;

/**
 *
 */
class GuzzleExample03
{
    /**
     * @param RequestClient $requestClient
     * @param string $uri
     * @param string $router
     * @param string $username
     * @param string $password
     * @param array $header
     * @return false|string
     */
    public function exampleRequest(
        RequestClient $requestClient,
        string        $uri,
        string        $router,
        string        $username,
        string        $password,
        array         $header
    )
    {
        $return = (new HttpRequestAdapter())
            ->setClient($requestClient)
            ->basicAuth($username, $password)
            ->setHeader($header)
            ->setUri($uri)
            ->get('/' . $router);

        return json_encode($return);
    }
}
