<?php

namespace RequestManager\examples;

use RequestManager\RequestRunner;

/**
 * Exemplo de requisição com client padrão utilizando basicAuth
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
        array  $header
    )
    {
        $return = (new RequestRunner())
            ->basicAuth($username, $password)
            ->setHeader($header)
            ->setUri($uri)
            ->get('/' . $router);

        return json_encode($return);
    }
}