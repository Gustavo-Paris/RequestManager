<?php

namespace RequestManager\Http;

use RequestManager\Facades\HttpGuzzleRequest;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class HttpConstants
{
    /**
     * Constant GET for global utility
     */
    public const GET = 'GET';
    /**
     * Constant POST for global utility
     */
    public const POST = 'POST';
    /**
     * Constant PUT for global utility
     */
    public const PUT = 'PUT';
    /**
     * Constant PATCH for global utility
     */
    public const PATCH = 'PATCH';
    /**
     * Constant DELETE for global utility
     */
    public const DELETE = 'DELETE';
    /**
     * Constant CURL_LIB_GUZZLE for global utility
     */
    public const BODY_TYPE_MULTIPART = 'multipart';
    public const BODY_TYPE_JSON = 'json';
    public const BODY_TYPE_FORM_DATA = 'form_data';
    public const BODY_TYPE_BODY = 'body';
}
