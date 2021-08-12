<?php


namespace App\Engine\Engine;


use App\Engine\Entity\CollegeDetailsItem;
use App\Engine\Parser\CollegeDetailsParser;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class DetailsEngine
 * @package App\Engine\College
 */
class CollegeDetailsEngine extends AbstractEngine
{

    /**
     * @param string $url
     * @return CollegeDetailsItem|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function load(string $url): ?CollegeDetailsItem
    {
        $response = $this->client->request('GET', $url);
        if ($response->getStatusCode() != 200) {
//                $this->errors[] = "Error connect to {$url}";
            return null;
        }
        $content = $response->getContent();

        $parser = new CollegeDetailsParser();
        return $parser->parse($url, $content);
    }

}