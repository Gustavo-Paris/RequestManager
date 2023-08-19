<?php

namespace RequestManager\Validator;

use RequestManager\Exception\HttpException;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class DataRequestValidator
{
    /**
     * @var HttpException
     */
    private $httpException;

    /**
     * @param array $data
     * @return void
     * @throws HttpException
     */
    public function validateDataRequestEmpty(array $data)
    {
        if (empty($data)) {
            throw new HttpException($this->httpException->exception(1));
        }
    }

    /**
     * @param HttpException $httpException
     * @return DataRequestValidator
     */
    public function setHttpException(HttpException $httpException): DataRequestValidator
    {
        $this->httpException = $httpException;
        return $this;
    }
}
