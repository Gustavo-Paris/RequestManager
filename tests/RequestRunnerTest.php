<?php

namespace RequestManager\Tests;

use PHPUnit\Framework\TestCase;
use RequestManager\RequestRunner;
use RequestManager\Http\GuzzleRequest;

/**
 * Template File Doc Comment
 *
 * PHP version 7.3
 *
 * @category
 * @package  RequestRunnerTest.php
 * @author   Author <wesley.sartori@ixcsoft.com.br>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://packagist/gustavo-paris/request-manager
 */
class RequestRunnerTest extends TestCase
{
    /**
     * @var RequestRunner
     */
    private $requestRunner;

    /**
     * @return void
     */
    public function testSetClient(): void
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->setClient((new GuzzleRequest()));
        $this->assertInstanceOf(RequestRunner::class, $actual);
    }

    /**
     * @return void
     */
    public function testSetHeaderAuth(): void
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->setHeader(['header' => 'teste']);
        $this->assertInstanceOf(RequestRunner::class, $actual);
    }

    /**
     * @return void
     */
    public function testBasicAuth(): void
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->basicAuth('test', 'test');
        $this->assertInstanceOf(RequestRunner::class, $actual);
    }

    /**
     * @return void
     */
    public function testBearerToken(): void
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->bearerToken('02SAdasd0adsad');
        $this->assertInstanceOf(RequestRunner::class, $actual);
    }

    /**
     * @return void
     */
    public function testSetUri(): void
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->setUri('https://api.com.br');
        $this->assertInstanceOf(RequestRunner::class, $actual);
    }

    /**
     * @return void
     */
    public function testSetData(): void
    {
        $this->requestRunner = new RequestRunner();
        $actual = $this->requestRunner->setData(['data' => []]);
        $this->assertInstanceOf(RequestRunner::class, $actual);
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

        $this->requestRunner = new RequestRunner();
        $this->requestRunner->setClient($guzzleRequest);
        $this->requestRunner->basicAuth('user', 'pass');
        $this->requestRunner->setUri('https://api.com.br/');
        $this->requestRunner->setHeader(['header']);
        $this->requestRunner->setData(['data' => 'data']);

        $actual = $this->requestRunner->run('post');
        self::assertEquals([], $actual);
    }

    /**
     * @return void
     */
    public function testRunIsNull(): void
    {
        $requestRunnerMock = $this->createMock(RequestRunner::class);
        $requestRunnerMock->method('setClient')->willReturnCallback(function () {
            return new GuzzleRequest();
        });

        $guzzleRequest = $this->createMock(GuzzleRequest::class);
        $guzzleRequest->method('request')->willReturnCallback(function () {
            return null;
        });

        $requestRunnerMock->setUri('https://api.com.br/');
        $requestRunnerMock->setHeader(['header']);
        $requestRunnerMock->setData(['multipart' => ['data' => 'dados']]);
        $actual = $requestRunnerMock->run('post');

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
