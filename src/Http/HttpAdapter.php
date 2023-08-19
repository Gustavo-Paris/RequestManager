<?php

namespace RequestManager\Http;

use Exception;
use RequestManager\Facades\HttpGuzzleRequest;
use RequestManager\Http\Manager\GetHttpRequest;
use RequestManager\Interfaces\IHttpAdapter;
use RequestManager\Providers\Providers;
use Pimple\Container;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class HttpAdapter
{
    public const CLIENTS = [
        HttpGuzzleRequest::class,
    ];
    /**
     * @var IHttpAdapter
     */
    private $client;

    /**
     * @var Container
     */
    private $container;

    /**
     * @param ?IHttpAdapter $iHttpAdapter
     * @throws Exception
     */
    public function __construct(?IHttpAdapter $iHttpAdapter = null)
    {
        $this->setContainer((new Container()));
        $this->getContainer()->register((new Providers()));
        $this->getContainer()->offsetSet(IHttpAdapter::class, $iHttpAdapter);
        $this->setClient($iHttpAdapter);
    }

    /**
     * @return IHttpAdapter
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ?IHttpAdapter $client
     * @return $this
     * @throws Exception
     * Atualmente é suportado apenas a biblioteca HttpGuzzleRequest
     */
    public function setClient(?IHttpAdapter $client = null): HttpAdapter
    {
        if(empty($client)) {
            $this->getContainer()->offsetSet(IHttpAdapter::class, (new HttpGuzzleRequest()));
            $this->client = $this->getContainer()
                ->offsetGet(GetHttpRequest::class)
                ->getType($this->getContainer()->offsetGet(HttpGuzzleRequest::class));
            return $this;
        }

        $this->client = $this->getContainer()->offsetGet(GetHttpRequest::class)->getType($client);
        return $this;
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @param Container $container
     */
    public function setContainer(Container $container): void
    {
        $this->container = $container;
    }
}
