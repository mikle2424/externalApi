<?php

declare(strict_types=1);

namespace src\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class InMemoryPool implements CacheItemPoolInterface
{
    private $storage;

    public function __construct(array &$storage)
    {
        $this->storage = &$storage;
    }

    public function getItem($key)
    {
        /** @var CacheItemInterface $item */
        foreach ($this->storage as $item) {
            if ($item->getKey() === $key) {
                return $item;
            }
        }

        return new InMemoryItem($key, null);
    }

    public function getItems(array $keys = array())
    {
        // TODO: Implement deleteItems() method.
    }

    public function hasItem($key)
    {
        return
            count(
                array_filter(
                    $this->storage,
                    function (CacheItemInterface $item) use ($key) {
                        return $item->getKey() === $key;
                    }
                )
            ) > 0;
    }

    public function clear()
    {
        // TODO: Implement deleteItems() method.
    }

    public function deleteItem($key)
    {
        // TODO: Implement deleteItems() method.
    }

    public function deleteItems(array $keys)
    {
        // TODO: Implement deleteItems() method.
    }

    public function save(CacheItemInterface $item)
    {
        $this->storage[$item->getKey()] = $item;
    }

    public function saveDeferred(CacheItemInterface $item)
    {
        // TODO: Implement saveDeferred() method.
    }

    public function commit()
    {
        // TODO: Implement commit() method.
    }

}