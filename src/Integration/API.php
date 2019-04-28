<?php

namespace src\Integration;

use src\Http\Response\Response;

interface API
{
    public function get(array $request): Response;
}