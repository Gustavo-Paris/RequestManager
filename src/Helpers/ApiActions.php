<?php

namespace RequestManager\Helpers;

class ApiActions
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
