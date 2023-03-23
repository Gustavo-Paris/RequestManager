<?php

namespace RequestManager\examples;

use RequestManager\RequestRunner;

/**
 *
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
        array $header
    )
    {
        $return = (new RequestRunner())
            ->setHeader($header)
            ->setUri($uri)
            ->get('/' . $router);

        return json_encode($return);
    }
}
