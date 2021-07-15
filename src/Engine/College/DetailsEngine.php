<?php


namespace App\Engine\College;


use App\Engine\Entity\DetailsItem;
use App\Engine\Entity\DetailsItemInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class DetailsEngine
 * @package App\Engine\College
 */
class DetailsEngine implements DetailsEngineInterface
{

    /**
     * @var DetailsParser
     */
    private $parser;

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * DetailsEngine constructor.
     * @param DetailsParser $parser
     * @param HttpClientInterface $client
     */
    public function __construct(DetailsParser $parser, HttpClientInterface $client)
    {
        $this->parser = $parser;
        $this->client = $client;
    }

    /**
     * @param string $url
     * @return DetailsItem|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function load(string $url): ?DetailsItemInterface
    {
        $response = $this->client->request('GET', $url);
        if ($response->getStatusCode() != 200) {
//                $this->errors[] = "Error connect to {$url}";
            return null;
        }
        $content = $response->getContent();

        return $this->parser->parse($url, $content);
    }

}