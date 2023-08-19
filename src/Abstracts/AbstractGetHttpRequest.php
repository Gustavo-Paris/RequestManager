<?php

namespace RequestManager\Abstracts;

use Exception;
use RequestManager\Interfaces\IHttpAdapter;

abstract class AbstractGetHttpRequest
{
    /**
     * @var AbstractGetHttpRequest|null
     */
    protected $next;

    /**
     * @param string $type
     * @return IHttpAdapter
     * @throws Exception
     */
    abstract public function getType(string $type): IHttpAdapter;

    /**
     * @param AbstractGetHttpRequest|null $next
     * @return void
     */
    public function next(?AbstractGetHttpRequest $next): void
    {
        $this->next = $next;
    }
}
