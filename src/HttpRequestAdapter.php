<?php

namespace RequestManager;

use RequestManager\Helpers\ApiConstants;
use RequestManager\Interfaces\RequestClient;
use RequestManager\Http\GuzzleRequestAdapter;

/**
 * Template File Doc Comment
 *
 * PHP version 7.3
 *
 * @category Class of HttpRequest
 * @package  HttpRequest.php
 * @description Class responsible for calls via API, whenever you perform some
 * action it will be necessary to instantiate this request class
 *
 * @author Gustavo Paris <gustavo.paris@ixcsoft.com.br>
 * @author Wesley Bonfim Sartóri <wesley.sartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class HttpRequestAdapter
{
    /**
     * @var null
     */
    protected $client = null;
    /**
     * @var string
     */
    private $uri;

    /**
     * @var array|null
     */
    private $auth = null;

    /**
     * @var array|null
     */
    private $header = null;

    /**
     * @var array
     */
    private $data;

    private $ssl = false;

    /**
     * @param RequestClient|null $client
     * @return HttpRequestAdapter
     */
    public function setClient(?RequestClient $client = null): HttpRequestAdapter
    {
        $this->client = !is_null($client) ? $client : new GuzzleRequestAdapter();
        return $this;
    }

    /**
     * @param string $username
     * @param string $password
     * @return $this
     */
    public function basicAuth(string $username, string $password): HttpRequestAdapter
    {
        $this->auth = [$username, $password];
        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function bearerTokenAuth(string $token): HttpRequestAdapter
    {
        $this->auth = ['Authorization' => 'Bearer ' . $token];
        return $this;
    }

    /**
     * @return array|null
     */
    public function getHeader(): ?array
    {
        return $this->header;
    }

    /**
     * @param array $header
     * @return $this
     */
    public function setHeader(array $header = ['Content-type' => 'application/json']): HttpRequestAdapter
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function setUri(string $uri): HttpRequestAdapter
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data): HttpRequestAdapter
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $route
     * @return array
     */
    public function post(string $route = ''): array
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiConstants::POST);
    }

    /**
     * @param string $route
     * @return array
     */
    public function get(string $route = '')
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiConstants::GET);
    }

    /**
     * @param string $route
     * @return array
     */
    public function put(string $route = ''): array
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiConstants::PUT);
    }

    /**
     * @param string $route
     * @return array
     */
    public function delete(string $route = ''): array
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiConstants::DELETE);
    }

    /**
     * @param string $method
     * @return array
     */
    public function run(string $method)
    {
        if (is_null($this->client)) {
            $this->setClient();
        }

        if (!empty($this->data)) {
            $this->client->setData($this->data);
        }

        $this->client->setAuth($this->auth);
        $this->client->setUri($this->uri);

        if ($this->header) {
            $this->client->setHeader($this->header);
        }

        if ($this->getSsl()) {
            if (method_exists($this->client, 'setSsl')) {
                $this->client->setSSL($this->ssl);
            }
        }

        return $this->client->request($method);
    }

    /**
     * @return bool
     */
    private function getSsl(): bool
    {
        return $this->ssl;
    }


    /**
     * @param bool $ssl
     * @return $this
     */
    public function setSsl(bool $ssl): HttpRequestAdapter
    {
        $this->ssl = $ssl;
        return $this;
    }
}
