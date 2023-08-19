<?php

namespace RequestManager\Validator;

use RequestManager\Exception\HttpException;

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
