<?php

namespace App\Engine\Engine;

use App\Engine\College\MajorCategoryParser;
use App\Engine\Entity\MajorCategoryListItem;
use App\Engine\Entity\MajorCategoryListResult;

class MajorCategoryEngine extends AbstractEngine
{

    public function load(string $url, ?MajorCategoryListItem $parentMajor = null): ?MajorCategoryListResult
    {
        $response = $this->client->request('GET', $url);
        if ($response->getStatusCode() != 200) {
//                $this->errors[] = "Error connect to {$url}";
            return null;
        }
        $content = $response->getContent();

        $parser = new MajorCategoryParser();
        $parser->setParentMajor($parentMajor);
        return $parser->parse($url, $content);
    }

}