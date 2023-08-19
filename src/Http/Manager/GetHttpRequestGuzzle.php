<?php

namespace RequestManager\Http\Manager;

use RequestManager\Abstracts\AbstractGetHttpRequest;
use RequestManager\Facades\HttpGuzzleRequest;
use RequestManager\Http\HttpConstants;
use RequestManager\Interfaces\IHttpAdapter;

class GetHttpRequestGuzzle extends AbstractGetHttpRequest
{
    /**
     * @var HttpGuzzleRequest
     */
    private $httpGuzzleRequest;

    public function getType(string $type): IHttpAdapter
    {
        if ($type === HttpConstants::CURL_LIB_GUZZLE) {
            return $this->httpGuzzleRequest;
        }

        return $this->next->getType($type);
    }

    /**
     * @param HttpGuzzleRequest $httpGuzzleRequest
     */
    public function setHttpGuzzleRequest(HttpGuzzleRequest $httpGuzzleRequest): void
    {
        $this->httpGuzzleRequest = $httpGuzzleRequest;
    }
}
