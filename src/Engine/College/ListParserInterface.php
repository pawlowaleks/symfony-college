<?php

namespace App\Engine\College;

use App\Engine\Entity\ListResultInterface;

/**
 * Interface ListParserInterface
 * @package App\Engine\College
 */
interface ListParserInterface
{
    /**
     * @param string $url
     * @param string $content
     * @return ListResultInterface|null
     */
    public function parse(string $url, string $content): ?ListResultInterface;
}