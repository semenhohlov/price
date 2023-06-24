<?php

namespace App\Shared\Service\Logger;

interface LoggerInterface
{
    public function log(string $message): void;
    public function error(string $message): void;
}