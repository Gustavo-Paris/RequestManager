<?php

namespace RequestManager\Requests;

use Curl\Curl;
use Exception;
use RequestManager\Helpers\ApiActions;
use RequestManager\Interfaces\RequestClient;

class PhpCurlClassRequest implements RequestClient
{
    /** @var string */
    private string $uri = '';
    /** @var array|null */
    private ?array $header = null;
    /** @var array|null */
    private ?array $data = null;
    /** @var array|null */
    private ?array $auth = null;
    /** @var Curl */
    private Curl $client;

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
     * @return mixed
     * @throws Exception
     */
    public function request(string $method): mixed
    {
        $this->setClient((new Curl()));
        $this->setPrivateOptions();

        $this->getClient()->setOpt(CURLOPT_SSL_VERIFYPEER, 0);
        $this->getClient()->setOpt(CURLOPT_SSL_VERIFYHOST, 0);
        //TODO: verificar uma maneira melhor de setar os metodos que vem do parametro
        $this->getClient()->$method($this->uri, $this->data);

        if ($this->getClient()->error) {
            $this->handleException($this->getClient());
        }

        echo json_encode([
            'code' => $this->getClient()->getHttpStatusCode(),
            'message' => $this->getClient()->response,
        ]);

        return [];
    }

    /**
     * @return void
     */
    private function setPrivateOptions()
    {
        if (!is_null($this->header)) {
            $this->getClient()->setHeaders($this->header);
        }
        if (!is_null($this->auth)) {
            $this->getClient()->setBasicAuthentication($this->auth[0], $this->auth[1]);
        }
    }

    /**
     * @param $client
     * @return array
     * @throws Exception
     */
    public function handleException($client): array
    {
        if (!in_array($client->errorCode, ApiActions::HTTP_CODE_SUCCESS)) {
            throw new Exception($client->errorMessage);
        }
        return [];
    }

    /**
     * @return Curl
     */
    public function getClient(): Curl
    {
        return $this->client;
    }

    /**
     * @param Curl $client
     */
    public function setClient(Curl $client): void
    {
        $this->client = $client;
    }
}
