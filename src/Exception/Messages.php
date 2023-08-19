<?php

namespace RequestManager\Exception;

class Messages
{

    /**
     * @param string $message
     * @param int $code
     * @return mixed
     */
    public function messages(int $code, string $message = '')
    {
        $messages = [
            0 => sprintf('%s', $message),
            1 => sprintf('Corpo da requisi��o inv�lido! %s', $message),
        ];

        return $messages[$code];
    }
}
