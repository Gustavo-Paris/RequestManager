<?php

namespace RequestManager\Http\Manager;

use Exception;
use RequestManager\Interfaces\IHttpAdapter;
use RequestManager\Interfaces\IHttpRequestType;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class GetHttpRequest implements IHttpRequestType
{
    /**
     * @var GetHttpRequestNotFound
     */
    private $getHttpRequestNotFound;

    /**
     * @var GetHttpRequestGuzzle
     */
    private $getHttpRequestGuzzle;

    /**
     * @param IHttpAdapter $type
     * @return IHttpAdapter
     * @throws Exception
     */
    public function getType(IHttpAdapter $type): IHttpAdapter
    {
        $this->getHttpRequestNotFound->next(null);
        $this->getHttpRequestGuzzle->next($this->getHttpRequestNotFound);
        $httpRequest = $this->getHttpRequestGuzzle;

        return $httpRequest->getType($type);
    }

    /**
     * @param GetHttpRequestNotFound $getHttpRequestNotFound
     */
    public function setGetHttpRequestNotFound(GetHttpRequestNotFound $getHttpRequestNotFound): void
    {
        $this->getHttpRequestNotFound = $getHttpRequestNotFound;
    }

    /**
     * @param GetHttpRequestGuzzle $getHttpRequestGuzzle
     */
    public function setGetHttpRequestGuzzle(GetHttpRequestGuzzle $getHttpRequestGuzzle): void
    {
        $this->getHttpRequestGuzzle = $getHttpRequestGuzzle;
    }
}
