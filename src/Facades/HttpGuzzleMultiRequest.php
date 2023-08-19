<?php

namespace RequestManager\Facades;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use Throwable;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class HttpGuzzleMultiRequest
{
    /**
     * @var array
     */
    private $arrayPromise = [];
    /**
     * @var array
     */
    private $auth = [];

    /**
     * @var array
     */
    private $header = [];

    /**
     * @var array
     */
    private $body = [];

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var array
     */
    private $response = [];

    /**
     * @var array
     */
    private $responsePromisse = [];

    /**
     * @var Client
     */
    private $client;

    /**
     * @return array|mixed
     * @throws Throwable
     */
    public function send()
    {
        $this->generateArrayPromises();

        $this->response = Utils::settle(
            Utils::unwrap($this->getArrayPromise())
        )->wait();

        return $this->response;
    }

    /**
     * @return array
     */
    public function generateArrayPromises(): array
    {
        foreach ($this->body['body'] as $key => $value) {
            $method = $this->generateMethodType($value['method']);
            $this->setOptions($value);
            $this->setArrayPromise($this->getClient()->$method($value['router'], $this->getOptions()));
        }

        return $this->getArrayPromise();
    }

    /**
     * @param string $method
     * @return string
     */
    private function generateMethodType(string $method): string
    {
        return strtolower($method) . 'Async';
    }

    /**
     * @param array $data
     * @return array
     */
    public function response(array $data): array
    {
        foreach ($data as $key => $value) {
            $this->setResponsePromisse(json_decode($data[$key]['value']->getBody()->getContents(), true));
        }

        return $this->getResponsePromisse();
    }

    /**
     * @return array
     */
    public function getAuth(): array
    {
        return $this->auth;
    }

    /**
     * @param array $auth
     */
    public function setAuth(array $auth): void
    {
        $this->auth['auth'] = $auth;
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @param array $header
     */
    public function setHeader(array $header): void
    {
        $this->header = $header;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param array $body
     */
    public function setBody(array $body): void
    {
        $this->body = $body;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        if (!is_null($this->auth)) {
            $this->options['auth'] = $this->auth;
        }
        if (!is_null($this->header)) {
            $this->options['headers'] = $this->header;
        }
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    /**
     * @param array $response
     */
    public function setResponse(array $response): void
    {
        $this->response = $response;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function getArrayPromise(): array
    {
        return $this->arrayPromise;
    }

    /**
     * @param $router
     */
    public function setArrayPromise($router): void
    {
        $this->arrayPromise[] = $router;
    }

    /**
     * @return array
     */
    public function getResponsePromisse(): array
    {
        return $this->responsePromisse;
    }

    /**
     * @param array $responsePromisse
     */
    public function setResponsePromisse(array $responsePromisse): void
    {
        $this->responsePromisse[] = $responsePromisse;
    }
}
