<?php

namespace test\Unit\Integration\SomeService;

use src\Cache\InMemoryItem;
use src\Cache\InMemoryPool;
use src\Http\Code\Successful;
use src\Integration\SomeService\WithCache;
use PHPUnit\Framework\TestCase;
use src\Integration\FakeApi;

class WithCacheTest extends TestCase
{
    public function testWithExistingCacheData()
    {
        $cacheStorage =
            [
                new InMemoryItem('21569ba1bde12af52941484c3b675f1f6ca045d5', 'test value from cache'),
                new InMemoryItem('f97b7d7cd3f6e2150f2c5618ec4193f3cb0dec8f', 'second value from cache'),
            ];

        $firstResult =
            (new WithCache(
                new FakeApi($this->data()),
                new InMemoryPool($cacheStorage)
            ))
                ->get(['action' => 'test']);
        $this->assertEquals((new Successful())->value(), $firstResult->code()->value());
        $this->assertEquals('test value from cache', $firstResult->body());

        $secondResult =
            (new WithCache(
                new FakeApi($this->data()),
                new InMemoryPool($cacheStorage)
            ))
                ->get(['action' => 'test2']);
        $this->assertEquals((new Successful())->value(), $secondResult->code()->value());
        $this->assertEquals('second value from cache', $secondResult->body());
    }

    public function testWithUsingCache()
    {
        $cacheStorage = [];

        $request = ['action' => 'test'];

        $result =
            (new WithCache(
                new FakeApi($this->data()),
                new InMemoryPool($cacheStorage)
            ))
                ->get($request);

        $this->assertEquals((new Successful())->value(), $result->code()->value());
        $this->assertEquals($this->data(), $result->body());
        $this->assertEquals($this->data(), reset($cacheStorage)->get());
    }

    private function data(): string
    {
        return 'test data from fake API';
    }
}
