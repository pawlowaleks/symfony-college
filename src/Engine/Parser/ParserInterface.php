<?php

namespace App\Engine\Parser;

use App\Engine\Entity\AbstractEntity;

interface ParserInterface
{

    /**
     * @param string $url
     * @param string $content
     * @return AbstractEntity|null
     */
    public function parse(string $url, string $content): ?AbstractEntity;

}