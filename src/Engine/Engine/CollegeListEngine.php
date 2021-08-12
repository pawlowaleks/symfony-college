<?php

namespace App\Engine\Engine;

use App\Engine\Entity\CollegeListResult;
use App\Engine\Parser\CollegeListParser;
use App\Entity\Major;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class ListEngine
 * @package App\Engine\College
 */
class CollegeListEngine extends AbstractEngine
{

    /**
     * @param string $url
     * @param Major|null $major
     * @return CollegeListResult|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
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