<?php

namespace test\Unit\Integration\SomeService;

use PHPUnit\Framework\TestCase;
use src\Http\Code\Successful;
use src\Http\Credentials\DefaultCredentials;
use src\Http\Transport\FakeTransport;
use src\Integration\SomeService\SomeService;

class SomeServiceTest extends TestCase
{
    public function testSuccessful()
    {
        $result =
            (new SomeService(
                new DefaultCredentials('', ''),
                new FakeTransport()
            ))
                ->get([]);

        $this->assertEquals((new Successful())->value(), $result->code()->value());
        $this->assertEquals('default response data', $result->body());
    }
}
