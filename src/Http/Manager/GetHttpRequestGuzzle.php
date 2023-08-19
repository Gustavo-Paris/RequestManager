<?php

namespace RequestManager\Http\Manager;

use RequestManager\Abstracts\AbstractGetHttpRequest;
use RequestManager\Facades\HttpGuzzleRequest;
use RequestManager\Http\HttpConstants;
use RequestManager\Interfaces\IHttpAdapter;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
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
