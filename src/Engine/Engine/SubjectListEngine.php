<?php

namespace App\Engine\Engine;

use App\Engine\Entity\AbstractEntity;
use App\Engine\Parser\SubjectListParser;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class SubjectListEngine extends AbstractEngine
{

    /**
     * @param string $url
     * @return AbstractEntity|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function load(string $url): ?AbstractEntity
    {
        $response = $this->client->request('GET', $url);
        if ($response->getStatusCode() != 200) {
//                $this->errors[] = "Error connect to {$url}";
            return null;
        }
        $content = $response->getContent();
        $parser = new SubjectListParser();
        return $parser->parse($url, $content);
    }
}