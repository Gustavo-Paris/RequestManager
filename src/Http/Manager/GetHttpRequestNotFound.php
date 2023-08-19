<?php

namespace RequestManager\Http\Manager;

use RequestManager\Abstracts\AbstractGetHttpRequest;
use RequestManager\Facades\HttpGuzzleRequest;
use RequestManager\Interfaces\IHttpAdapter;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
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
