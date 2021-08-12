<?php

namespace App\Engine\Engine;

use App\Engine\Entity\AbstractEntity;

interface EngineInterface
{

    /**
     * @param string $url
     * @return AbstractEntity|null
     */
    public function load(string $url): ?AbstractEntity;

}