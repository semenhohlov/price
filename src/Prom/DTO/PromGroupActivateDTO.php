<?php

namespace App\Prom\DTO;

class PromGroupActivateDTO
{
    private ?bool $activate = true;

    public function getActivate()
    {
        return $this->activate;
    }

    public function setActivate($activate)
    {
        $this->activate = $activate;

        return $this;
    }
}