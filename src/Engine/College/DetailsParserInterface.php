<?php


namespace App\Engine\College;


use App\Engine\Entity\DetailsItem;

/**
 * Interface DetailsParserInterface
 * @package App\Engine\College
 */
interface DetailsParserInterface
{
    /**
     * @param string $url
     * @param string $content
     * @return DetailsItem|null
     */
    public function parse(string $url, string $content): ?DetailsItem;
}