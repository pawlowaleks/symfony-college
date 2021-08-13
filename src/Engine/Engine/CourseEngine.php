<?php

namespace App\Engine\Engine;

use App\Engine\Entity\CourseResult;
use App\Engine\Entity\SubjectItem;
use App\Engine\Parser\CourseParser;

class CourseEngine extends AbstractEngine
{

    public function load(string $url, SubjectItem $subjectItem = null): ?CourseResult
    {
        $response = $this->client->request('GET', $url);
        if ($response->getStatusCode() != 200) {
//                $this->errors[] = "Error connect to {$url}";
            return null;
        }
        $content = $response->getContent();

        $parser = new CourseParser();
        return $parser->parse($url, $content, $subjectItem);
    }
}