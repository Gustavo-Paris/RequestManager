<?php
namespace RequestManager;

use RequestManager\Interfaces\RequestClient;
use RequestManager\Requests\GuzzleRequest;

/**
 *
 */
class RequestRunner
{
    /**
     * @var RequestClient $client
     */
    protected RequestClient $client;

    /**
     * @var string
     */
    private string $uri;

    /**
     * @var string|null
     */
    private ?string $auth = null;

    /**
     * @var array|null
     */
    private ?array $header = null;

    /**
     *
     */
    const GET = 'get';

    /**
     *
     */
    const POST = 'post';

    /**
     *
     */
    const UPDATE = 'update';

    /**
     *
     */
    const DELETE = 'delete';

    /**
     * @var array
     */
    private array $data;

    /**
     * @param RequestClient|null $client
     * @return RequestRunner
     */
    public function setClient(?RequestClient $client): RequestRunner
    {
        $this->client = $client ?? new GuzzleRequest();
        return $this;
    }

    /**
     * @param string $username
     * @param string $password
     * @return $this
     */
    public function basicAuth(string $username, string $password): RequestRunner
    {
        $this->auth = (base64_encode($username . ':' . $password));
        return $this;
    }

    /**
     * @param array $header
     * @return $this
     */
    public function setHeader(array $header): RequestRunner
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function setUri(string $uri): RequestRunner
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data): RequestRunner
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
        $this->uri = $this->uri . DIRECTORY_SEPARATOR . $route;
        return $this->run(self::POST);
    }

    /**
     * @param string $route
     * @return array
     */
    public function get(string $route): array
    {
        $this->uri = $this->uri . DIRECTORY_SEPARATOR . $route;
        return $this->run(self::GET);
    }

    /**
     * @param string $route
     * @return array
     */
    public function update(string $route): array
    {
        $this->uri = $this->uri . DIRECTORY_SEPARATOR . $route;
        return $this->run(self::UPDATE);
    }

    /**
     * @param string $route
     * @return array
     */
    public function delete(string $route): array
    {
        $this->uri = $this->uri . DIRECTORY_SEPARATOR . $route;
        return $this->run(self::DELETE);
    }

    /**
     * @param string $method
     * @return array
     */
    public function run(string $method): array
    {
        $this->client->setAuth($this->auth);
        $this->client->setUri($this->uri);
        $this->client->setHeader($this->header);
        $this->client->setData($this->data);

        return $this->client->request($method);
    }

}