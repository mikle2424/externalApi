<?php

namespace src\Http\Transport;

use src\Http\Response\Response;

interface HttpTransport
{
    public function response(array $request): Response;
}