<?php

namespace RequestManager\Entities;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wesley.sartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class MultiDataEntity
{
    /**
     * @var string
     */
    private $router = '';
    /**
     * @var string
     */
    private $method = '';
    /**
     * @var string
     */
    private $type = '';
    /**
     * @var array
     */
    private $data = [];
    /**
     * @var array
     */
    private $headers = [];
    /**
     * @var array
     */
    private $options = [];
    /**
     * @var array
     */
    private $auth = [];

    /**
     * @return string
     */
    public function getRouter(): string
    {
        return $this->router;
    }

    /**
     * @param string $router
     * @return MultiDataEntity
     */
    public function setRouter(string $router): MultiDataEntity
    {
        $this->router = $router;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return MultiDataEntity
     */
    public function setMethod(string $method): MultiDataEntity
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return MultiDataEntity
     */
    public function setType(string $type): MultiDataEntity
    {
        $this->type = $type;
        return $this;
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
     * @return MultiDataEntity
     */
    public function setData(array $data): MultiDataEntity
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return MultiDataEntity
     */
    public function setHeaders(array $headers): MultiDataEntity
    {
        $this->headers = $headers;
        return $this;
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
     * @return MultiDataEntity
     */
    public function setOptions(array $options): MultiDataEntity
    {
        $this->options = $options;
        return $this;
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
     * @return MultiDataEntity
     */
    public function setAuth(array $auth): MultiDataEntity
    {
        $this->auth = $auth;
        return $this;
    }
}
