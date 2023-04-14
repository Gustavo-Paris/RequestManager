<?php

namespace RequestManager\Tests;

use PHPUnit\Framework\TestCase;
use RequestManager\RequestRunner;
use RequestManager\Requests\GuzzleRequest;

class RequestRunnerTest extends TestCase
{
    /**
     * @var RequestRunner
     */
    private $requestRunner;


    /**
     * @return void
     */
    public function testSetClient()
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->setClient((new GuzzleRequest()));
        $this->assertInstanceOf(RequestRunner::class, $actual);
    }

    public function testSetHeaderAuth()
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->setHeader(['header' => 'teste']);
        $this->assertInstanceOf(RequestRunner::class, $actual);
    }

    public function testBasicAuth()
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->basicAuth('test', 'test');
        $this->assertInstanceOf(RequestRunner::class, $actual);
    }

    public function testBearerToken()
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->bearerToken('02SAdasd0adsad');
        $this->assertInstanceOf(RequestRunner::class, $actual);
    }

    public function testSetUri()
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->setUri('https://api.com.br');
        $this->assertInstanceOf(RequestRunner::class, $actual);
    }

    public function testSetData()
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->setData(['data' => []]);
        $this->assertInstanceOf(RequestRunner::class, $actual);
    }


    public function testRun()
    {
        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function (){
           return [];
        });

        $this->requestRunner = new RequestRunner();
        $this->requestRunner->setClient($guzzleRequest);
        $this->requestRunner->basicAuth('user', 'pass');
        $this->requestRunner->setUri('https://api.com.br/');
        $this->requestRunner->setHeader(['header']);
        $this->requestRunner->setData(['data' => 'data']);

        $actual = $this->requestRunner->run('post');
        self::assertEquals([], $actual);
    }

    public function testRunIsNull()
    {
        $requestRunnerMock = $this->createMock(RequestRunner::class);
        $requestRunnerMock->method('setClient')->willReturnCallback(function () {
            return new GuzzleRequest();
        });

        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function (){
           return null;
        });

        $requestRunnerMock->setUri('https://api.com.br/');
        $requestRunnerMock->setHeader(['header']);
        $requestRunnerMock->setData(['multipart' => ['data' => 'dados']]);
        $actual = $requestRunnerMock->run('post');

        self::assertEmpty($actual, '');
    }

    public function testPost()
    {
        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function (){
            return ['response' => [
                'data' => 'data'
            ]];
        });

        $this->requestRunner = new RequestRunner();
        $this->requestRunner->setClient($guzzleRequest);
        $this->requestRunner->basicAuth('user', 'pass');
        $this->requestRunner->setUri('https://api.com.br/');
        $this->requestRunner->setHeader(['header']);
        $this->requestRunner->setData(['data' => 'data']);

        $actual = $this->requestRunner->post('post');

        $this->assertEquals(['response' => [
            'data' => 'data'
        ]], $actual);
    }

    public function testGet()
    {
        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function (){
            return ['response' => [
                'code' => 200,
                'message' => 'Listed successfuly',
                'data' => [],
            ]];
        });

        $this->requestRunner = new RequestRunner();
        $this->requestRunner->setClient($guzzleRequest);
        $this->requestRunner->basicAuth('user', 'pass');
        $this->requestRunner->setUri('https://api.com.br/');
        $this->requestRunner->setHeader(['header']);
        $this->requestRunner->setData(['data' => 'data']);

        $actual = $this->requestRunner->get('get');

        $this->assertEquals(['response' => [
            'code' => 200,
            'message' => 'Listed successfuly',
            'data' => [],
        ]], $actual);
    }

    public function testPut()
    {
        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function (){
            return ['response' => [
                'code' => 200,
                'message' => 'Updated successfuly',
            ]];
        });

        $this->requestRunner = new RequestRunner();
        $this->requestRunner->setClient($guzzleRequest);
        $this->requestRunner->basicAuth('user', 'pass');
        $this->requestRunner->setUri('https://api.com.br/');
        $this->requestRunner->setHeader(['header']);
        $this->requestRunner->setData(['data' => 'data']);

        $actual = $this->requestRunner->put('put');

        $this->assertEquals(['response' => [
            'code' => 200,
            'message' => 'Updated successfuly',
        ]], $actual);
    }

    public function testDelete()
    {
        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function (){
            return ['response' => [
                'code' => 200,
                'message' => 'Deleted successfuly',
            ]];
        });

        $this->requestRunner = new RequestRunner();
        $this->requestRunner->setClient($guzzleRequest);
        $this->requestRunner->basicAuth('user', 'pass');
        $this->requestRunner->setUri('https://api.com.br/');
        $this->requestRunner->setHeader(['header']);
        $this->requestRunner->setData(['data' => 'data']);

        $actual = $this->requestRunner->delete('delete');

        $this->assertEquals(['response' => [
            'code' => 200,
            'message' => 'Deleted successfuly',
        ]], $actual);
    }
}
