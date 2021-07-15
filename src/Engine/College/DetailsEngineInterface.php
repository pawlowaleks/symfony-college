<?php


namespace App\Engine\College;

use App\Engine\Entity\DetailsItem;

/**
 * Interface DetailsEngineInterface
 * @package App\Engine\College
 */
interface DetailsEngineInterface
{
    /**
     * @param string $url
     * @return DetailsItem|null
     */
    public function load(string $url): ?DetailsItem;
}