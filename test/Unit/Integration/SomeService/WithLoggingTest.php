<?php

namespace test\Unit\Integration\SomeService;

use src\Http\Response\Response;
use src\Integration\API;
use src\Integration\FakeApi;
use src\Log\InMemory;
use PHPUnit\Framework\TestCase;
use src\Integration\SomeService\WithLogging;
use Exception;

class WithLoggingTest extends TestCase
{
    public function testWithLogging()
    {
        $logStorage = [];

        $result =
            (new WithLogging(
                new class($this->exceptionError()) implements API
                {
                    private $exceptionError;

                    public function __construct(string $exceptionError)
                    {
                        $this->exceptionError = $exceptionError;
                    }

                    public function get(array $request): Response
                    {
                        throw new Exception($this->exceptionError);
                    }
                },
                [new InMemory($logStorage)]
            ))
                ->get([]);

        $this->assertEquals('Internal error', $result->body());
        $this->assertEquals($this->exceptionError(), reset($logStorage));

    }

    public function testWithNonLogInIterable()
    {
        try {
            (new WithLogging(
                new FakeApi(''),
                ['nonLog']
            ))->get([]);
            $this->fail('Exception expected');
        } catch (Exception $exception)
        {
            $this->assertEquals('Only LogInterfaces allowed in constructor', $exception->getMessage());
        }
    }

    private function exceptionError(): string
    {
        return 'exception error';
    }
}
