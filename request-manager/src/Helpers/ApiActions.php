<?php

namespace RequestManager\Helpers;

class ApiActions
{
    /** @const GET */
    const GET = 'get';
    /** @const POST */
    const POST = 'post';
    /** @const UPDATE */
    const PUT = 'put';
    /** @const DELETE */
    const DELETE = 'delete';

    const HTTP_CODE_SUCCESS = [200, 201, 202];
}
