<?php

namespace RequestManager\Exception;

use Exception;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class HttpException extends Exception
{
    /**
     * @var Messages
     */
    private $messages;

    /**
     * @param int $code
     * @param string $message
     * @return mixed
     */
    public function exception(int $code, string $message = '')
    {
        return $this->messages->messages($code, $message = '');
    }

    /**
     * @param Messages $messages
     * @return HttpException
     */
    public function setMessages(Messages $messages): HttpException
    {
        $this->messages = $messages;
        return $this;
    }
}
