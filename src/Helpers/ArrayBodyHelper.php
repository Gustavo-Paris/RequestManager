<?php

namespace RequestManager\Helpers;

use RequestManager\Exception\HttpException;
use RequestManager\Validator\DataRequestValidator;

class ArrayBodyHelper
{
    /**
     * @var DataRequestValidator
     */
    private $dataRequestValidator;

    private $options = [];

    /**
     * @param array $data
     * @return array
     */
    public function handleMultipart(array $data): array
    {
        $options = [];

        foreach ($data as $key => $value) {
            $options['multipart'][] = [
                "name" => $key,
                "contents" => $value
            ];
        }

        $this->setOptions($options);

        return $this->getOptions();
    }

    /**
     * @param array $data
     * @return array
     * @throws HttpException
     */
    public function handleJson(array $data): array
    {
        $options = [];

        $this->dataRequestValidator->validateDataRequestEmpty($data);
        $options['json'] = $data;

        $this->setOptions($options);
        return $this->getOptions();
    }

    /**
     * @param DataRequestValidator $dataRequestValidator
     */
    public function setDataRequestValidator(DataRequestValidator $dataRequestValidator): void
    {
        $this->dataRequestValidator = $dataRequestValidator;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return ArrayBodyHelper
     */
    public function setOptions(array $options): ArrayBodyHelper
    {
        $this->options = $options;
        return $this;
    }
}
