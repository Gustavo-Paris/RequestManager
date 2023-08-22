<?php

namespace RequestManager\Facades;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use RequestManager\Helpers\ArrayBodyHelper;
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
    private $data = [];

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var array
     */
    private $multiOptions = [];

    /**
     * @var array
     */
    private $response = [];

    /**
     * @var array
     */
    private $responsePromisse = [];

    /**
     * @var string
     */
    private $uri = '';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var ArrayBodyHelper
     */
    private $arrayBodyHelper;

    /**
     * @return array
     * @throws Throwable
     */
    public function send(): array
    {
        $this->generateArrayPromises();

        $this->response = Utils::settle(
            Utils::unwrap($this->getArrayPromise())
        )->wait();

        return $this->handleResponse($this->response);
    }

    /**
     * @return array
     */
    public function generateArrayPromises(): array
    {
        foreach ($this->getOptions() as $key => $value) {
            $method = $this->generateMethodType($value['method']);
            $router = $this->generateUri($value['router']);
            unset($value['router'], $value['method']);

            $this->setOptions($value);
            $this->setArrayPromise($this->getClient()->$method($router, $this->getOptions()));
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
     * @param string $uri
     * @return string
     */
    private function generateUri(string $uri): string
    {
        return $this->getUri() . DIRECTORY_SEPARATOR . $uri;
    }

    /**
     * @param array $data
     * @return array
     */
    private function handleResponse(array $data): array
    {
        foreach ($data as $key => $value) {
            $this->setResponsePromisse(json_decode($data[$key]['value']->getBody()->getContents(), true));
        }

        return $this->getResponsePromisse();
    }

    /**
     * @return array
     */
    public function response(): array
    {
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
     * @param string $type
     * @return array
     */
    public function setAuth(array $auth, string $type = ''): array
    {
        if ($type === 'basicAuth') {
            $this->auth['auth'] = [$auth['username'], $auth['password']];
            return $this->auth;
        } elseif ($type === 'bearerToken') {
            $this->header['headers'] = [
                'Authorization' => 'Bearer ' . $auth['token'],
                'Accept' => 'application/json',
            ];

            return $this->header;
        }

        return [];
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
        $this->header['headers'] = $header;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        if (array_key_exists($data['type'], HttpGuzzleRequest::BODY_TYPES)) {
            $method = HttpGuzzleRequest::BODY_TYPES[$data['type']];
            $this->arrayBodyHelper->$method($data['data']);
        }
        $this->data = $data;
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
     * @return void
     */
    private function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @param array $options
     */
    public function setMultiOptions(array $options): void
    {
        $newOptions = [];

        foreach ($options as $option) {
            if (!empty($option['auth'])) {
                $this->multiOptions['auth'] = [
                    $option['auth']['data']['username'],
                    $option['auth']['data']['password']
                ];
            }

            if (!empty($option['headers'])) {
                $this->multiOptions['headers'] = $option['headers'];
            }

            if (!empty($option['options']['data'])) {
                if (array_key_exists($option['options']['type'], HttpGuzzleRequest::BODY_TYPES)) {
                    $method = HttpGuzzleRequest::BODY_TYPES[$option['options']['type']];
                    $type = $option['options']['type'];
                    $this->arrayBodyHelper->$method($option['options']['data']);
                    $this->multiOptions[$type] = $this->arrayBodyHelper->getOptions()[$type];
                }
            }
            $this->multiOptions['router'] = $option['router'];
            $this->multiOptions['method'] = $option['method'];
            $newOptions[] = $this->multiOptions;
        }

        $this->setOptions($newOptions);
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

    /**
     * @param ArrayBodyHelper $arrayBodyHelper
     */
    public function setArrayBodyHelper(ArrayBodyHelper $arrayBodyHelper): void
    {
        $this->arrayBodyHelper = $arrayBodyHelper;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }
}
