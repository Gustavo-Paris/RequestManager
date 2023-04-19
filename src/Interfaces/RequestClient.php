<?php

namespace RequestManager\Interfaces;

/**
 * Template File Doc Comment
 *
 * PHP version 7.3
 *
 * @category Class of interfaces
 * @package  RequestClient.php
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
interface RequestClient
{
    public function setAuth(array $auth): void;

    public function setUri(string $uri): void;

    public function setHeader(array $header): array;

    public function setData(array $data): void;

    public function request(string $method);
}
