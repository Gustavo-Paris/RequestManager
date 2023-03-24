<?php

namespace RequestManager\examples;

use RequestManager\Interfaces\RequestClient;
use RequestManager\RequestRunner;

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
        return (new RequestRunner())
            ->setClient($requestClient)
            ->basicAuth($username, $password)
            ->setHeader($header)
            ->setUri($uri)
            ->get('/' . $router);
    }
}