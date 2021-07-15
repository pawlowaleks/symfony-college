<?php


namespace App\Engine\College;


use App\Engine\Entity\DetailsItemInterface;

/**
 * Interface DetailsParserInterface
 * @package App\Engine\College
 */
interface DetailsParserInterface
{
    /**
     * @param string $url
     * @param string $content
     * @return DetailsItemInterface|null
     */
    public function parse(string $url, string $content): ?DetailsItemInterface;
}