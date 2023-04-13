<?php

namespace RequestManager\Tests;

use PHPUnit\Framework\TestCase;
use RequestManager\Requests\GuzzleRequest;

class RequestRunnerTest extends TestCase
{
    /**
     * @var GuzzleRequest
     */
    private $guzzleRequestMock;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->guzzleRequest = new GuzzleRequest();
    }

    /**
     * @return void
     */
    public function testBasicAuth()
    {
        $this->guzzleRequestMock = $this->createPartialMock(GuzzleRequest::class, ['setHeader']);
        $this->guzzleRequestMock->method('setHeader')->willReturnCallback(function () {
            return ['header' => 'teste'];
        });

        $actual = $this->guzzleRequestMock->setHeader(['header' => 'teste']);

        $this->assertEquals(['header' => 'teste'], $actual);
    }
}
