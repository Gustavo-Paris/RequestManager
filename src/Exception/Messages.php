<?php

namespace RequestManager\Exception;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @category Curl
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class Messages
{
    /**
     * @param int $code
     * @param string $message
     * @return mixed
     */
    public function messages(int $code, string $message = '')
    {
        $messages = [
            0 => sprintf('%s', $message),
            1 => sprintf('Corpo da requisição inválido! %s', $message),
        ];

        return $messages[$code];
    }
}
