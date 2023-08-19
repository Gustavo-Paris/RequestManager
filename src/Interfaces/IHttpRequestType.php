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
interface IHttpRequestType
{
    /**
     * @param IHttpAdapter $type
     * @return mixed
     */
    public function getType(IHttpAdapter $type): IHttpAdapter;
}
