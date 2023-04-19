<?php

namespace RequestManager\Tests;

use PHPUnit\Framework\TestCase;
use RequestManager\HttpRequest;
use RequestManager\Http\GuzzleRequest;

/**
 * Template File Doc Comment
 *
 * PHP version 7.3
 *
 * @category
 * @package  httpRequestTest.php
 * @author   Author <wesley.sartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class HttpRequestTest extends TestCase
{
    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * @return void
     */
    public function testSetClient(): void
    {
        $this->httpRequest = new HttpRequest();
        $actual = $this->httpRequest->setClient((new GuzzleRequest()));
        $this->assertInstanceOf(HttpRequest::class, $actual);
    }

    /**
     * @return void
     */
    public function testSetHeaderAuth(): void
    {
        $this->httpRequest = new HttpRequest();
        $actual = $this->httpRequest->setHeader(['header' => 'teste']);
        $this->assertInstanceOf(httpRequest::class, $actual);
    }

    /**
     * @return void
     */
    public function testBasicAuth(): void
    {
        $this->httpRequest = new HttpRequest();
        $actual = $this->httpRequest->basicAuth('test', 'test');
        $this->assertInstanceOf(httpRequest::class, $actual);
    }

    /**
     * @return void
     */
    public function testBearerToken(): void
    {
        $this->httpRequest = new HttpRequest();
        $actual = $this->httpRequest->bearerTokenAuth('02SAdasd0adsad');
        $this->assertInstanceOf(httpRequest::class, $actual);
    }

    /**
     * @return void
     */
    public function testSetUri(): void
    {
        $this->httpRequest = new HttpRequest();
        $actual = $this->httpRequest->setUri('https://api.com.br');
        $this->assertInstanceOf(httpRequest::class, $actual);
    }

    /**
     * @return void
     */
    public function testSetData(): void
    {
        $this->httpRequest = new HttpRequest();
        $actual = $this->httpRequest->setData(['data' => []]);
        $this->assertInstanceOf(httpRequest::class, $actual);
    }


    /**
     * @return void
     */
    public function testRun(): void
    {
        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function () {
            return [];
        });

        $this->httpRequest = new HttpRequest();
        $this->httpRequest->setClient($guzzleRequest);
        $this->httpRequest->basicAuth('user', 'pass');
        $this->httpRequest->setUri('https://api.com.br/');
        $this->httpRequest->setHeader(['header']);
        $this->httpRequest->setData(['data' => 'data']);

        $actual = $this->httpRequest->run('post');
        self::assertEquals([], $actual);
    }

    /**
     * @return void
     */
    public function testRunIsNull(): void
    {
        $httpRequestMock = $this->createMock(httpRequest::class);
        $httpRequestMock->method('setClient')->willReturnCallback(function () {
            return new GuzzleRequest();
        });

        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function () {
            return null;
        });

        $httpRequestMock->setUri('https://api.com.br/');
        $httpRequestMock->setHeader(['header']);
        $httpRequestMock->setData(['multipart' => ['data' => 'dados']]);
        $actual = $httpRequestMock->run('post');

        self::assertEmpty($actual, '');
    }

    /**
     * @return void
     */
    public function testPost(): void
    {
        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function () {
            return ['response' => [
                'data' => 'data'
            ]];
        });

        $this->httpRequest = new HttpRequest();
        $this->httpRequest->setClient($guzzleRequest);
        $this->httpRequest->basicAuth('user', 'pass');
        $this->httpRequest->setUri('https://api.com.br/');
        $this->httpRequest->setHeader(['header']);
        $this->httpRequest->setData(['data' => 'data']);

        $actual = $this->httpRequest->post('post');

        $this->assertEquals(['response' => [
            'data' => 'data'
        ]], $actual);
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function () {
            return ['response' => [
                'code' => 200,
                'message' => 'Listed successfuly',
                'data' => [],
            ]];
        });

        $this->httpRequest = new HttpRequest();
        $this->httpRequest->setClient($guzzleRequest);
        $this->httpRequest->basicAuth('user', 'pass');
        $this->httpRequest->setUri('https://api.com.br/');
        $this->httpRequest->setHeader(['header']);
        $this->httpRequest->setData(['data' => 'data']);

        $actual = $this->httpRequest->get('get');

        $this->assertEquals(['response' => [
            'code' => 200,
            'message' => 'Listed successfuly',
            'data' => [],
        ]], $actual);
    }

    /**
     * @return void
     */
    public function testPut(): void
    {
        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function () {
            return ['response' => [
                'code' => 200,
                'message' => 'Updated successfuly',
            ]];
        });

        $this->httpRequest = new HttpRequest();
        $this->httpRequest->setClient($guzzleRequest);
        $this->httpRequest->basicAuth('user', 'pass');
        $this->httpRequest->setUri('https://api.com.br/');
        $this->httpRequest->setHeader(['header']);
        $this->httpRequest->setData(['data' => 'data']);

        $actual = $this->httpRequest->put('put');

        $this->assertEquals(['response' => [
            'code' => 200,
            'message' => 'Updated successfuly',
        ]], $actual);
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function () {
            return ['response' => [
                'code' => 200,
                'message' => 'Deleted successfuly',
            ]];
        });

        $this->httpRequest = new HttpRequest();
        $this->httpRequest->setClient($guzzleRequest);
        $this->httpRequest->basicAuth('user', 'pass');
        $this->httpRequest->setUri('https://api.com.br/');
        $this->httpRequest->setHeader(['header']);
        $this->httpRequest->setData(['data' => 'data']);

        $actual = $this->httpRequest->delete('delete');

        $this->assertEquals(['response' => [
            'code' => 200,
            'message' => 'Deleted successfuly',
        ]], $actual);
    }
}
