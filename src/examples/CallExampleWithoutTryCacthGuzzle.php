<?php

namespace RequestManager\examples;

use Exception;
use RequestManager\HttpRequest;
use RequestManager\Http\GuzzleRequest;

/**
 * Template File Doc Comment
 *
 * PHP version 7.3
 *
 * @category Example of request
 * @package  CallExampleWithoutTryCacthGuzzle.php
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class CallExampleWithoutTryCacthGuzzle
{
    private const UNITS_LIST = 'unidades';

    /**
     * @param array $data
     * @return array
     */
    public function request(array $data)
    {
        $url = sprintf(
            '%s%s',
            '/',
            self::UNITS_LIST
        );

        return (new HttpRequest())
            ->setClient(new GuzzleRequest())
            ->basicAuth($data['username'], $data['password'])
            ->setHeader(['ixcsoft' => 'listar'])
            ->setUri($data['url'])
            ->get($url);
    }
}
