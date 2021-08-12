<?php

namespace App\Engine\Engine;

use App\Engine\Entity\CollegeListResult;
use App\Engine\Parser\CollegeListParser;
use App\Entity\Major;

/**
 * Class ListEngine
 * @package App\Engine\College
 */
class CollegeListEngine extends AbstractEngine
{

    /**
     * @param string $url
     * @return CollegeListResult|null
     */
    public function load(string $url, ?Major $major = null): ?CollegeListResult
    {
        $response = $this->client->request('GET', $url);
        if ($response->getStatusCode() != 200) {
//                $this->errors[] = "Error connect to {$url}";
            return null;
        }
        $content = $response->getContent();

        $parser = new CollegeListParser();
        return $parser->parse($url, $content, $major);
    }

}