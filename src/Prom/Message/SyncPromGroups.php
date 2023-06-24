<?php

namespace App\Prom\Message;

class SyncPromGroups
{
    private ?string $token = null;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }
}