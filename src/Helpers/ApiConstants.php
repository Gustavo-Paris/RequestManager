<?php

namespace RequestManager\Helpers;

/**
 * Template File Doc Comment
 *
 * PHP version 7.3
 *
 * @category Class of constants
 * @package  ApiActions.php
 * @author   Author <wesley.sartori@ixcsoft.com.br>
 * @author   Author <gustavo.paris@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class ApiConstants
{
    /** @const GET */
    public const GET = 'get';
    /** @const POST */
    public const POST = 'post';
    /** @const UPDATE */
    public const PUT = 'put';
    /** @const DELETE */
    public const DELETE = 'delete';

    public const HTTP_CODE_SUCCESS = [200, 201, 202];
}
