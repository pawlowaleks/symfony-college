<?php

namespace App\Engine\College;

use App\Engine\Entity\ListResultInterface;

/**
 * Interface ListEngineInterface
 * @package App\Engine\College
 */
interface ListEngineInterface
{
    /**
     * @param string $url
     * @return ListResultInterface|null
     */
    public function load(string $url): ?ListResultInterface;
}