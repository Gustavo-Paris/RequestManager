<?php

namespace RequestManager\examples;

use Exception;
use RequestManager\RequestRunner;
use RequestManager\Requests\GuzzleRequest;

class CallExampleWithoutTryCacthGuzzle
{
    private const UNITS_LIST = 'unidades';
    public function request(array $data)
    {
        $url = sprintf('%s%s',
            '/', self::UNITS_LIST
        );

        return (new RequestRunner())
            ->setClient(new GuzzleRequest())
            ->basicAuth($data['username'], $data['password'])
            ->setHeader(['ixcsoft' => 'listar'])
            ->setUri($data['url'])
            ->get($url);
    }
}