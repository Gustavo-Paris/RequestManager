<?php

namespace RequestManager;

use RequestManager\Helpers\ApiActions;
use RequestManager\Interfaces\RequestClient;
use RequestManager\Requests\GuzzleRequest;

/**
 *
 */
class RequestRunner
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
     * @param  RequestClient|null $client
     * @return RequestRunner
     */
    public function setClient(?RequestClient $client = null): RequestRunner
    {
        $this->client = !is_null($client) ? $client : new GuzzleRequest();
        return $this;
    }

    /**
     * @param  string $username
     * @param  string $password
     * @return $this
     */
    public function basicAuth(string $username, string $password): RequestRunner
    {
        $this->auth = [$username, $password];
        return $this;
    }

    /**
     * @param  string $token
     * @return $this
     */
    public function bearerToken(string $token): RequestRunner
    {
        $this->auth = ['Authorization' => 'Bearer ' . $token];
        return $this;
    }

    /**
     * @param  array $header
     * @return $this
     */
    public function setHeader(array $header): RequestRunner
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param  string $uri
     * @return $this
     */
    public function setUri(string $uri): RequestRunner
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param  array $data
     * @return $this
     */
    public function setData(array $data): RequestRunner
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param  string $route
     * @return array
     */
    public function post(string $route): array
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiActions::POST);
    }

    /**
     * @param  string $route
     * @return array
     */
    public function get(string $route)
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiActions::GET);
    }

    /**
     * @param  string $route
     * @return array
     */
    public function put(string $route): array
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiActions::PUT);
    }

    /**
     * @param  string $route
     * @return array
     */
    public function delete(string $route): array
    {
        $this->uri = $this->uri . $route;
        return $this->run(ApiActions::DELETE);
    }

    /**
     * @param  string $method
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
