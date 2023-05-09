<?php

namespace RequestManager\Http;

use Curl\Curl;
use Exception;
use RequestManager\Helpers\ApiActions;
use RequestManager\Interfaces\RequestClient;

/**
 * Template File Doc Comment
 *
 * PHP version 7.3
 *
 * @category Class PhpCurlClass Client Request
 * @package  PhpCurlClassRequest.php
 * @author   Author <wesley.sartori@ixcsoft.com.br>
 * @author   Author <gustavo.paris@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class PhpCurlClassRequest implements RequestClient
{
    /** @var string */
    private $uri = '';
    /** @var array|null */
    private $header = null;
    /** @var array|null */
    private $data = null;
    /** @var array|null */
    private $auth = null;
    /** @var Curl */
    private $client;
    /** @var string */
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
        $this->header = $header;
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
     */
    public function request(string $method)
    {
        try {
            $this->setClient();
            $this->setPrivateOptions();

            $this->getClient()->$method($this->uri, json_encode($this->data));

            if ($this->getClient()->error) {
                $this->handleException($this->getClient());
            }

            return $this->handleResponse($this->getClient());

        } catch (Exception $exception) {
            return $this->handleException($exception);
        }
    }

    /**
     * @return void
     */
    private function setPrivateOptions()
    {
        if (!is_null($this->header)) {
            $this->getClient()->setHeaders($this->header);
        }
        if (!is_null($this->auth)) {
            $this->getClient()->setBasicAuthentication($this->auth[0], $this->auth[1]);
        }
    }

    /**
     * @param $response
     * @return array
     */
    private function handleResponse($response): array
    {
        return [
            'code' => $response->getHttpStatusCode(),
            'response' => $response->response
        ];
    }

    /**
     * @param $response
     * @return array
     */
    public function handleException($response): array
    {
        return [
            'code' => $response->getHttpStatusCode(),
            'response' => $response->response,
        ];
    }

    /**
     * @return Curl
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return void
     */
    public function setClient(): void
    {
        $this->client = new Curl();
    }

    /**
     * @return array
     */
    public function getSsl()
    {
        return $this->ssl;
    }

    /**
     * @param array|string $flag
     * @return void
     */
    public function setSsl($flag = false): array
    {
        $this->ssl = [];

        if($flag) {
            return [
                'CURLOPT_SSL_VERIFYPEER' => 0,
                'CURLOPT_SSL_VERIFYHOST' => 0,
            ];
        }
    }
}
