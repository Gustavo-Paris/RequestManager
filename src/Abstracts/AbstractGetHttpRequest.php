<?php

namespace RequestManager\Abstracts;

use Exception;
use RequestManager\Interfaces\IHttpAdapter;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
abstract class AbstractGetHttpRequest
{
    /**
     * @var AbstractGetHttpRequest|null
     */
    protected $next;

    /**
     * @param IHttpAdapter $type
     * @return IHttpAdapter
     * @throws Exception
     */
    abstract public function getType(IHttpAdapter $type): IHttpAdapter;

    /**
     * @param AbstractGetHttpRequest|null $next
     * @return void
     */
    public function next(?AbstractGetHttpRequest $next): void
    {
        $this->next = $next;
    }
}
