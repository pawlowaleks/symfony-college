<?php


namespace App\Engine\College;

use App\Engine\Entity\DetailsItemInterface;

/**
 * Interface DetailsEngineInterface
 * @package App\Engine\College
 */
interface DetailsEngineInterface
{
    /**
     * @param string $url
     * @return DetailsItemInterface|null
     */
    public function load(string $url): ?DetailsItemInterface;
}