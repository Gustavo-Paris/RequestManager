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
}
