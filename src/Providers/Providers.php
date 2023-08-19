<?php

namespace RequestManager\Providers;

use GuzzleHttp\Client;
use RequestManager\Exception\HttpException;
use RequestManager\Exception\Messages;
use RequestManager\Facades\HttpGuzzleMultiRequest;
use RequestManager\Facades\HttpGuzzleRequest;
use RequestManager\Http\HttpAdapter;
use RequestManager\Http\Manager\GetHttpRequest;
use RequestManager\Http\Manager\GetHttpRequestGuzzle;
use RequestManager\Http\Manager\GetHttpRequestNotFound;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use RequestManager\Validator\DataRequestValidator;

class Providers implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $this->registerAdapters($pimple);
    }

    /**
     * @param Container $pimple
     * @return void
     */
    public function registerAdapters(Container $pimple): void
    {

        $pimple->offsetSet(Messages::class, function () {
            return new Messages();
        });

        $pimple->offsetSet(HttpException::class, function (Container $pimple) {
            $httpException = new HttpException();
            $httpException->setMessages($pimple[Messages::class]);
            return $httpException;
        });

        $pimple->offsetSet(DataRequestValidator::class, function (Container $pimple) {
            $dataRequestValidator = new DataRequestValidator();
            $dataRequestValidator->setHttpException($pimple[HttpException::class]);
            return $dataRequestValidator;
        });

        $pimple->offsetSet(Client::class, function () {
            return new Client();
        });

        $pimple->offsetSet(HttpGuzzleMultiRequest::class, function () {
            return new HttpGuzzleMultiRequest();
        });

        $pimple->offsetSet(HttpGuzzleRequest::class, function (Container $pimple) {
            $httpGuzzleRequest = new HttpGuzzleRequest();
            $httpGuzzleRequest->setClient($pimple[Client::class]);
            $httpGuzzleRequest->setHttpGuzzleMultiRequest($pimple[HttpGuzzleMultiRequest::class]);
            $httpGuzzleRequest->setDataRequestValidator($pimple[DataRequestValidator::class]);
            return $httpGuzzleRequest;
        });

        $pimple->offsetSet(GetHttpRequestGuzzle::class, function (Container $pimple) {
            $getHttpRequestGuzzle = new GetHttpRequestGuzzle();
            $getHttpRequestGuzzle->setHttpGuzzleRequest($pimple[HttpGuzzleRequest::class]);
            return $getHttpRequestGuzzle;
        });

        $pimple->offsetSet(GetHttpRequestNotFound::class, function (Container $pimple) {
            $getHttpRequestNotFound = new GetHttpRequestNotFound();
            $getHttpRequestNotFound->setHttpGuzzleRequest($pimple[HttpGuzzleRequest::class]);
            return $getHttpRequestNotFound;
        });

        $pimple->offsetSet(GetHttpRequest::class, function (Container $pimple) {
            $getHttpRequest = new GetHttpRequest();
            $getHttpRequest->setGetHttpRequestGuzzle($pimple[GetHttpRequestGuzzle::class]);
            $getHttpRequest->setGetHttpRequestNotFound($pimple[GetHttpRequestNotFound::class]);
            return $getHttpRequest;
        });

        $pimple->offsetSet(GetHttpRequest::class, function (Container $pimple) {
            $getHttpRequest = new GetHttpRequest();
            $getHttpRequest->setGetHttpRequestGuzzle($pimple[GetHttpRequestGuzzle::class]);
            $getHttpRequest->setGetHttpRequestNotFound($pimple[GetHttpRequestNotFound::class]);
            return $getHttpRequest;
        });

        $pimple->offsetSet(HttpAdapter::class, function (Container $pimple) {
            $httpAdapter = new HttpAdapter();
            $httpAdapter->setContainer($pimple);
            return $httpAdapter;
        });
    }
}
