<?php

namespace RequestManager\Http\Manager;

use Exception;
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

    /**
     * @param IHttpAdapter $type
     * @return IHttpAdapter
     * @throws Exception
     */
    public function getType(IHttpAdapter $type): IHttpAdapter
    {
        if ($type === $this->httpGuzzleRequest) {
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
