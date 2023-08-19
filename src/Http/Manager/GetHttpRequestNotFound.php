<?php

namespace RequestManager\Http\Manager;

use RequestManager\Abstracts\AbstractGetHttpRequest;
use RequestManager\Facades\HttpGuzzleRequest;
use RequestManager\Http\HttpConstants;
use RequestManager\Interfaces\IHttpAdapter;

class GetHttpRequestNotFound extends AbstractGetHttpRequest
{
    /**
     * @var HttpGuzzleRequest
     */
    private $httpGuzzleRequest;

    public function getType(string $type): IHttpAdapter
    {
        return $this->httpGuzzleRequest;
    }

    /**
     * @param HttpGuzzleRequest $httpGuzzleRequest
     */
    public function setHttpGuzzleRequest(HttpGuzzleRequest $httpGuzzleRequest): void
    {
        $this->httpGuzzleRequest = $httpGuzzleRequest;
    }
}
