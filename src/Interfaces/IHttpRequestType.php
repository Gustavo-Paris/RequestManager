<?php

namespace RequestManager\Interfaces;

interface IHttpRequestType
{
    /**
     * @param string $type
     * @return mixed
     */
    public function getType(string $type): IHttpAdapter;
}
