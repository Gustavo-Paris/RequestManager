<?php

namespace RequestManager\Http;

use Exception;
use RequestManager\Http\Manager\GetHttpRequest;
use RequestManager\Interfaces\IHttpAdapter;
use RequestManager\Providers\Providers;
use Pimple\Container;

class HttpAdapter
{
    /**
     * @var IHttpAdapter
     */
    private $client;

    /**
     * @var Container
     */
    private $container;

    /**
     * @param string $client
     * @throws Exception
     */
    public function __construct(string $client = '')
    {
        $this->setContainer((new Container()));
        $this->getContainer()->register((new Providers()));
        $this->setClient($client);
    }

    /**
     * @return IHttpAdapter
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param string $client{$client => 'guzzle'}
     * @return $this
     * @throws Exception
     * Atualmente é suportado apenas a biblioteca GuzzleRequest
     */
    public function setClient(string $client = ''): HttpAdapter
    {
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
