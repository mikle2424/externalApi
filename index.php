<?php

use src\Integration\SomeService\WithLogging;
use src\Integration\SomeService\WithCache;
use src\Integration\SomeService\SomeService;
use src\Log\InMemory;
use src\Cache\InMemoryPool;
use src\Http\Credentials\DefaultCredentials;
use src\Http\Transport\RealTransport;

$logStorage = [];
$cacheStorage = [];

echo
    (new WithLogging(
        new WithCache(
            new SomeService(
                new DefaultCredentials('test', 'test'),
                new RealTransport('http://host.com:8080')
            ),
            new InMemoryPool($cacheStorage)
        ),
        [new InMemory($logStorage)]
    ))
        ->get(['action' => 'test'])
        ->body();
