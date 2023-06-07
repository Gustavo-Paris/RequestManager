<?php

namespace RequestManager\Http;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use RequestManager\Interfaces\InterfaceAuth;
use RequestManager\Interfaces\InterfaceData;
use RequestManager\Interfaces\InterfaceHeader;
use RequestManager\Interfaces\InterfaceRequest;
use RequestManager\Interfaces\InterfaceSSL;
use RequestManager\Interfaces\InterfaceUri;

/**
 * Template File Doc Comment
 *
 * PHP version 7.3
 *
 * @category Class Guzzle Client Request
 * @package  GuzzleRequest.php
 * @author   Author <wesley.sartori@ixcsoft.com.br>
 * @author   Author <gustavo.paris@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class GuzzleRequestAdapter implements
    InterfaceRequest,
    InterfaceHeader,
    InterfaceUri,
    InterfaceAuth,
    InterfaceSSL,
    InterfaceData
{
    /** Options for making requests via post */
    private const GUZZLE_ACTIONS_POST = ['form_params', 'body', 'multipart', 'json'];
    /** @var string */
    private $uri = '';
    /** @var array|null */
    private $header = null;
    /** @var array|null */
    private $data = null;
    /** @var array|null */
    private $auth = null;
    /** @var array|null */
    private $options = null;
    /** @var bool */
    private $ssl = [];

    /**
     * @param array|null $auth
     * @return void
     */
    public function setAuth(?array $auth = null): void
    {
        $this->auth = $auth;
    }

    /**
     * @param string $uri
     * @return void
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @param array $header
     * @return array
     */
    public function setHeader(array $header): array
    {
        return $this->header = $header;
    }

    /**
     * @param array $data
     * @return void
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @param string $method
     * @return array
     * @throws GuzzleException
     */
    public function request(string $method): array
    {
        try {
            $this->setOptions();

            $client = new Client($this->getSsl());

            $response = $client
                ->request(
                    $method,
                    $this->uri,
                    $this->options,
                );

            return $this->handleResponse($response);

        } catch (ClientException $clientException) {
            return $this->handleException($clientException);
        }
    }

    /**
     * @return void
     */
    private function setOptions(): void
    {
        if (!is_null($this->header)) {
            $this->options['headers'] = $this->header;
        }
        if (!is_null($this->auth)) {
            $this->options['auth'] = $this->auth;
        }
        if (!is_null($this->data)) {
            if ($this->data['multipart']) {
                foreach ($this->data['multipart'] as $key => $value) {
                    foreach ($this->data['multipart'][$key] as $key2 => $value2) {
                        $this->options['multipart'][] = [
                            "name" => $key2,
                            "contents" => $value2
                        ];
                    }
                }
            } else {
                foreach (self::GUZZLE_ACTIONS_POST as $keyAcions) {
                    if ($this->data[$keyAcions]) {
                        $this->options[$keyAcions] = $this->data[$keyAcions];
                    }
                }
            }

        }
    }

    /**
     * @param $exception
     * @return array
     * @throws Exception
     */
    public function handleException($exception): array
    {
        return [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage()
        ];
    }

    /**
     * @param $response
     * @return array
     */
    private function handleResponse($response): array
    {
        return [
            'code' => $response->getStatusCode(),
            'response' => json_decode($response->getBody()->getContents(), true)
        ];
    }

    /**
     * @return array|bool
     */
    public function getSsl()
    {
        return $this->ssl;
    }

    /**
     * @param array|string $flag
     * @return void
     */
    public function setSsl($flag = false): void
    {
        $this->ssl = [];

        if ($flag) {
            $this->ssl = ['verify' => false];
        }
    }
}
