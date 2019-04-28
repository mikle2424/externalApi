<?php

declare(strict_types=1);

namespace src\Integration\SomeService;

use Psr\Log\LoggerInterface;
use src\Http\Code\Failed;
use src\Http\Response\DefaultResponse;
use src\Http\Response\Response;
use src\Integration\API;
use Exception;

class WithLogging implements API
{
    private $api;
    private $logs;

    public function __construct(API $api, iterable $logs)
    {
        foreach ($logs as $log) {
            if (!($log instanceof LoggerInterface)) {
                throw new Exception('Only LogInterfaces allowed in constructor');
            }
        }

        $this->api = $api;
        $this->logs = $logs;
    }

    public function get(array $request): Response
    {
        try {
            return $this->api->get($request);
        } catch (Exception $exception) {
            /** @var LoggerInterface $log */
            foreach ($this->logs as $log) {
                $log->critical($exception->getMessage());
            }
        }

        return new DefaultResponse(new Failed(), 'Internal error');
    }
}