<?php

namespace App\Engine\Engine;

use App\Engine\Entity\MajorDetailsItem;
use App\Engine\Parser\MajorDetailsParser;

class MajorDetailsEngine extends AbstractEngine
{

    public function load(string $url): ?MajorDetailsItem
    {
        $response = $this->client->request('GET', $url);
        if ($response->getStatusCode() != 200) {
//                $this->errors[] = "Error connect to {$url}";
            return null;
        }
        $content = $response->getContent();

        $parser = new MajorDetailsParser();
        return $parser->parse($url, $content);
    }

}