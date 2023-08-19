<?php

namespace RequestManager\Interfaces;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
interface IHttpAdapter
{
    /**
     * @param string $route
     * @param bool $async
     */
    public function get(string $route, bool $async = false);

    /**
     * @param string $route
     * @param bool $async
     */
    public function post(string $route, bool $async = false);

    /**
     * @param string $route
     * @param bool $async
     */
    public function put(string $route, bool $async = false);

    /**
     * @param string $route
     * @param bool $async
     */
    public function delete(string $route, bool $async = false);

    /**
     * @return string
     */
    public function getUri(): string;

    /**
     * @param string $uri
     * @return IHttpAdapter
     */
    public function setUri(string $uri): IHttpAdapter;

    /**
     * @param array $ssl
     * @return IHttpAdapter
     */
    public function setSsl(array $ssl = []): IHttpAdapter;

    /**
     * @param array $auth
     * @param string $type
     * @return IHttpAdapter
     */
    public function setAuth(array $auth = [], string $type = ''): IHttpAdapter;

    /**
     * @param array $headers
     * @return IHttpAdapter
     */
    public function setHeader(array $headers): IHttpAdapter;

    /**
     * @return IHttpAdapter
     */
    public function sendMultiCurl(): IHttpAdapter;

    /**
     * @param array $data
     * @param string $type
     * @return IHttpAdapter
     */
    public function setData(array $data = [], string $type = ''): IHttpAdapter;

    /**
     * @param bool $flag
     * @return IHttpAdapter
     */
    public function enabledDebug(bool $flag = false): IHttpAdapter;
}
