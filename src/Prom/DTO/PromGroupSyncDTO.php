<?php

namespace App\Prom\DTO;

class PromGroupSyncDTO
{
    private ?string $token = null;

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}