<?php

namespace RequestManager;

use RequestManager\Helpers\ApiActions;
use RequestManager\Interfaces\RequestClient;
use RequestManager\Http\GuzzleRequest;

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
class HttpRequest
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

    /**
     * @param RequestClient|null $client
     * @return HttpRequest
     */
    public function setClient(?RequestClient $client = null): HttpRequest
    {
        $this->client = !is_null($client) ? $client : new GuzzleRequest();
        return $this;
    }

    /**
     * @param string $username
     * @param string $password
     * @return $this
     */
    public function basicAuth(string $username, string $password): HttpRequest
    {
        $this->auth = [$username, $password];
        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function bearerTokenAuth(string $token): HttpRequest
    {
        $this->auth = ['Authorization' => 'Bearer ' . $token];
        return $this;
    }

    /**
     * @param array $header
     * @return $this
     */
    public function setHeader(array $header): HttpRequest
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function setUri(string $uri): HttpRequest
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data): HttpRequest
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $route
     * @return array
     */
    public function post(string $route): array
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiActions::POST);
    }

    /**
     * @param string $route
     * @return array
     */
    public function get(string $route)
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiActions::GET);
    }

    /**
     * @param string $route
     * @return array
     */
    public function put(string $route): array
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiActions::PUT);
    }

    /**
     * @param string $route
     * @return array
     */
    public function delete(string $route): array
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiActions::DELETE);
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
        $this->client->setHeader($this->header);

        return $this->client->request($method);
    }
}
