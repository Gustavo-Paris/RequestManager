<?php

namespace RequestManager\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use RequestManager\Interfaces\RequestClient;

class GuzzleRequest implements RequestClient
{
    /** @var string */
    private string $uri = '';
    /** @var array|null */
    private ?array $header = null;
    /** @var array|null */
    private ?array $data = null;
    /** @var array|null */
    private ?array $auth = null;
    /** @var array|null */
    private ?array $options = null;

    /**
     * @param array|null $auth
     * @return void
     */
    public function setAuth(?array $auth = null): void
    {
        $this->auth = $auth;
    }

    /**
     * @param string $uri
     * @return void
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @param array $header
     * @return void
     */
    public function setHeader(array $header): void
    {
        $this->header = $header;
    }

    /**
     * @param array $data
     * @return void
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @param string $method
     * @return array|string
     * @throws GuzzleException
     */
    public function request(string $method): array
    {
        $this->setOptions();

        try {
            //TODO: parametros verify desabilita SSL
            $client = new Client(['verify' => false]);
            $response = $client
                ->request(
                    $method,
                    $this->uri,
                    $this->options,
                );

            return json_decode(
                $response->getBody()->getContents(),
                true
            );
        } catch (ClientException|RequestException $clientException)
        {
            return $this->handleException($clientException);
        }
    }

    /**
     * @return void
     */
    private function setOptions()
    {
        if (!is_null($this->header)) {
            $this->options['headers'] = $this->header;
        }
        if (!is_null($this->auth)) {
            $this->options['auth'] = $this->auth;
        }
        if (!is_null($this->data)) {
            $this->options['body'] = $this->data;
        }
    }

    /**
     * @param $clientException
     * @return array
     */
    public function handleException($clientException): array
    {
        if(isset($clientException->getHandlerContext()['error']) ){

            return [
                'code' => $clientException->getCode(),
                'message' => $clientException->getHandlerContext()['error']
            ];
        } else {
            return [
                'code' => $clientException->getCode(),
                'message' => $clientException->getMessage()
            ];
        }
    }
}
