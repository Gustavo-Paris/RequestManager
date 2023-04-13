<?php

namespace RequestManager\Requests;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use RequestManager\Helpers\ApiActions;
use RequestManager\Interfaces\RequestClient;

class GuzzleRequest implements RequestClient
{
    /** @var string */
    private $uri = '';
    /** @var array|null */
    private $header = null;
    /** @var array|null */
    private $data = null;
    /** @var array|null */
    private $auth = null;
    /** @var array|null */
    private $options = null;
    /** Options for making requests via post */
    private const GUZZLE_ACTIONS_POST = ['form_params', 'body', 'multipart', 'json'];

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
    }

    /**
     * @return array|void|null
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
            if ($this->data['multipart']) {
                foreach ($this->data['multipart'] as $key => $value) {
                    foreach ($this->data['multipart'][$key] as $key2 => $value2) {
                        $this->options['multipart'][] = [
                            "name" => $key2,
                            "contents" => $value2
                        ];
                    }
                }
            } else {
                foreach (self::GUZZLE_ACTIONS_POST as $keyAcions) {
                    if ($this->data[$keyAcions]) {
                        $this->options[$keyAcions] = $this->data[$keyAcions];
                    }
                }
            }

            return $this->options;
        }
    }

    /**
     * @param $response
     * @return array
     * @throws Exception
     */
    public function handleException($response): array
    {
        if (!in_array($response->getStatusCode(), ApiActions::HTTP_CODE_SUCCESS)) {
            return throw new ClientException('Error: ', $response, $response);
        }
    }

    /**
     * @param $response
     * @return array|mixed
     * @throws Exception
     */
    private function handleResponse($response)
    {
        if (in_array($response->getStatusCode(), ApiActions::HTTP_CODE_SUCCESS)) {
            return json_decode(
                $response->getBody()->getContents(),
                true
            );
        }

        return $this->handleException($response);
    }
}
