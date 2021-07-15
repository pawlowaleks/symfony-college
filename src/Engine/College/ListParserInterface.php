<?php

namespace App\Engine\College;

use App\Engine\Entity\ListResult;

/**
 * Interface ListParserInterface
 * @package App\Engine\College
 */
interface ListParserInterface
{
    /**
     * @param string $url
     * @param string $content
     * @return ListResult|null
     */
    public function parse(string $url, string $content): ?ListResult;
}