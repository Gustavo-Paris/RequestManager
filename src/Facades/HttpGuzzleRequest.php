<?php

namespace RequestManager\Facades;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use RequestManager\Exception\HttpException;
use RequestManager\Http\HttpConstants;
use RequestManager\Interfaces\IBasicAuthenticate;
use RequestManager\Interfaces\IBearerTokenAuthenticate;
use RequestManager\Interfaces\IHttpAdapter;
use RequestManager\Validator\DataRequestValidator;

/**
 * Template File Doc Comment
 * PHP version 7.3
 * @package  RequestManager
 * @author   Author <wbsartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class HttpGuzzleRequest implements
    IHttpAdapter,
    IBasicAuthenticate,
    IBearerTokenAuthenticate
{
    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var array
     */
    private $basicAuthenticate = [];

    /**
     * @var array
     */
    private $bearerTokenAutenthicate = [];

    /**
     * @var string
     */
    private $uri;
    /**
     * @var array[]
     */
    private $ssl = [];

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var Client
     */
    private $client;

    /**
     * Constants to autenthication type functions
     */
    private const AUTH_TYPES = [
        'basicAuth' => 'basicAuthenticate',
        'bearerToken' => 'bearerTokenAuthenticate',
    ];

    /**
     * Constant to body type functions
     */
    private const BODY_TYPES = [
        'multipart' => 'handleMultipart',
        'json' => 'handleJson',
        'body' => 'handleBody',
        'form_data' => 'handleFormData',
    ];

    /**
     * @var HttpGuzzleMultiRequest
     */
    private $httpGuzzleMultiRequest;

    /**
     * @var DataRequestValidator
     */
    private $dataRequestValidator;

    /**
     * @param string $method
     * @param string $route
     * @param bool $async
     * @return array
     * @throws GuzzleException
     */
    private function request(string $method, string $route, bool $async = false): array
    {
        try {
            if ($async) {
                $response = $this->getClient()
                    ->requestAsync(
                        $method,
                        $this->getUri() . $route,
                        $this->options
                    );

                return $this->handleResponse($response);
            }

            $response = $this->getClient()
                ->request(
                    $method,
                    $this->getUri() . $route,
                    $this->options
                );

            return $this->handleResponse($response);
        } catch (ClientException $clientException) {
            return $this->handleException($clientException);
        }
    }


    /**
     * @return IHttpAdapter
     * @throws \Throwable
     */
    public function sendMultiCurl(): IHttpAdapter
    {
        $this->httpGuzzleMultiRequest->setClient($this->getClient());

        if (!empty($this->basicAuthenticate)) {
            $this->httpGuzzleMultiRequest->setAuth($this->basicAuthenticate);
        }

        if (!empty($this->bearerTokenAutenthicate)) {
            $this->httpGuzzleMultiRequest->setAuth($this->bearerTokenAutenthicate);
        }

        if (!empty($this->body['data'])) {
            $this->httpGuzzleMultiRequest->setBody([]);
        }

        if (!empty($this->headers)) {
            $this->httpGuzzleMultiRequest->setHeader($this->headers);
        }

        if (!empty($this->options)) {
            $this->httpGuzzleMultiRequest->setOptions($this->options);
        }

        $this->httpGuzzleMultiRequest->send();

        return $this;
    }

    /**
     * @param string $route
     * @param bool $async
     * @return array
     * @throws GuzzleException
     */
    public function get(string $route, bool $async = false): array
    {
        return $this->request(HttpConstants::GET, $route, $async);
    }

    /**
     * @param string $route
     * @param bool $async
     * @return array
     * @throws GuzzleException
     */
    public function post(string $route, bool $async = false): array
    {
        return $this->request(HttpConstants::POST, $route, $async);
    }

    /**
     * @param string $route
     * @param bool $async
     * @return array
     * @throws GuzzleException
     */
    public function put(string $route, bool $async = false): array
    {
        return $this->request(HttpConstants::POST, $route, $async);
    }

    /**
     * @param string $route
     * @param bool $async
     * @return array
     * @throws GuzzleException
     */
    public function delete(string $route, bool $async = false): array
    {
        return $this->request(HttpConstants::POST, $route, $async);
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return IHttpAdapter
     */
    public function setUri(string $uri): IHttpAdapter
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @return array[]
     */
    public function getSsl(): array
    {
        return $this->ssl;
    }

    /**
     * @param array $ssl
     * @return IHttpAdapter
     */
    public function setSsl(array $ssl = []): IHttpAdapter
    {
        $this->ssl = ['verify' => $ssl];
        return $this;
    }

    /**
     * @param array $auth
     * @param string $type
     * @return IHttpAdapter
     */
    public function setAuth(array $auth = [], string $type = ''): IHttpAdapter
    {
        if (!empty($type) && array_key_exists($type, self::AUTH_TYPES)) {
            $method = self::AUTH_TYPES[$type];
            $this->$method($auth);
        }
        return $this;
    }

    /**
     * @param array $credentials
     * @return array
     */
    public function basicAuthenticate(array $credentials): array
    {
        return $this->options['auth'] = $credentials;
    }

    /**
     * @param array $credentials
     * @return array
     */
    public function bearerTokenAuthenticate(array $credentials): array
    {
        return $this->options['headers'] = [
            'Authorization' => 'Bearer ' . $credentials['token'],
            'Accept' => 'application/json',
        ];
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return IHttpAdapter
     */
    public function setHeaders(array $headers): IHttpAdapter
    {
        if (!empty($headers['headers'])) {
            $this->headers['headers'] = array_push($headers);
        } else {
            $this->headers['headers'] = $headers;
        }
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @param HttpGuzzleMultiRequest $httpGuzzleMultiRequest
     */
    public function setHttpGuzzleMultiRequest(HttpGuzzleMultiRequest $httpGuzzleMultiRequest): void
    {
        $this->httpGuzzleMultiRequest = $httpGuzzleMultiRequest;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @param string $type
     * @return IHttpAdapter
     */
    public function setData(array $data = [], string $type = ''): IHttpAdapter
    {
        if (empty($type)) {
            $type = 'json';
        }

        if (array_key_exists($type, self::BODY_TYPES)) {
            $method = self::BODY_TYPES[$type];
            $this->$method($data);
        }

        $this->data = $data;
        return $this;
    }

    /**
     * @param array $data
     * @return array
     */
    private function handleMultipart(array $data): array
    {
        if (!empty($data['data'])) {
            $data = $data['data'];
        }

        foreach ($data as $key => $value) {
            $this->options['multipart'][] = [
                "name" => $key,
                "contents" => $value
            ];
        }

        return $this->options;
    }

    /**
     * @param array $data
     * @return array
     * @throws HttpException
     */
    private function handleJson(array $data): array
    {
        $this->dataRequestValidator->validateDataRequestEmpty($data);
        return $this->options['json'] = $data;
    }

    /**
     * @param DataRequestValidator $dataRequestValidator
     * @return HttpGuzzleRequest
     */
    public function setDataRequestValidator(DataRequestValidator $dataRequestValidator): HttpGuzzleRequest
    {
        $this->dataRequestValidator = $dataRequestValidator;
        return $this;
    }

    /**
     * @param $response
     * @return array
     */
    public function handleResponse($response): array
    {
        return [
            'code' => $response->getStatusCode(),
            'response' => $response->getBody()->getContents()
        ];
    }

    /**
     * @param $exception
     * @return array
     */
    public function handleException($exception): array
    {
        return [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage()
        ];
    }
}
