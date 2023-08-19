<?php

namespace RequestManager\Exception;

use Exception;

class HttpException extends Exception
{
    /**
     * @var Messages
     */
    private $messages;

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
