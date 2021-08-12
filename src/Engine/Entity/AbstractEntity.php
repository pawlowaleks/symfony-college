<?php

namespace App\Engine\Entity;

abstract class AbstractEntity
{

    public function toArray(): array
    {
        return (array)$this;
    }
}