<?php

namespace App\Engine\Engine;

use App\Engine\College\MajorCategoryParser;
use App\Engine\Entity\MajorCategoryListItem;
use App\Engine\Entity\MajorCategoryListResult;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class MajorCategoryEngine extends AbstractEngine
{

    /**
     * @param string $url
     * @param MajorCategoryListItem|null $parentMajor
     * @return MajorCategoryListResult|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
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