<?php

declare(strict_types=1);

namespace src\Integration\SomeService;

use Psr\Cache\CacheItemPoolInterface;
use src\Cache\ExpiredInterval;
use src\Cache\Hashed;
use src\Http\Code\Successful;
use src\Http\Response\DefaultResponse;
use src\Http\Response\Response;
use src\Integration\API;
use DateTime;

class WithCache implements API
{
    private $api;
    private $cache;

    public function __construct(API $api, CacheItemPoolInterface $cache)
    {
        $this->api = $api;
        $this->cache = $cache;
    }

    public function get(array $request): Response
    {
        $cacheItem = $this->cache->getItem((new Hashed($request))->value());
        if ($cacheItem->isHit()) {
            return new DefaultResponse(new Successful(), $cacheItem->get());
        }

        $resultFromAPI = $this->api->get($request);

        $cacheItem
            ->set($resultFromAPI->body())
            ->expiresAt(
                (new DateTime('now'))
                    ->modify((new ExpiredInterval())->value())
            );

        $this->cache->save($cacheItem);

        return $resultFromAPI;
    }
}