<?php

namespace App\Engine\Entity;

class AbstractEntity implements EntityInterface
{

    public function toArray(): array
    {
        return (array)$this;
    }
}