<?php

namespace App\Engine\Engine;

use App\Engine\Entity\MajorDetailsItem;
use App\Engine\Parser\MajorDetailsParser;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class MajorDetailsEngine extends AbstractEngine
{

    /**
     * @param string $url
     * @return MajorDetailsItem|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
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