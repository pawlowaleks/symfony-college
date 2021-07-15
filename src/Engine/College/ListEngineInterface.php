<?php

namespace App\Engine\College;

use App\Engine\Entity\ListResult;

/**
 * Interface ListEngineInterface
 * @package App\Engine\College
 */
interface ListEngineInterface
{
    /**
     * @param string $url
     * @return ListResult|null
     */
    public function load(string $url): ?ListResult;
}