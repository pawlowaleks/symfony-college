<?php


namespace App\Engine\College;


use App\Engine\Entity\DetailsItem;
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
     * @var DetailsParserInterface
     */
    private DetailsParserInterface $parser;

    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $client;

    /**
     * DetailsEngine constructor.
     * @param DetailsParserInterface $parser
     * @param HttpClientInterface $client
     */
    public function __construct(DetailsParserInterface $parser, HttpClientInterface $client)
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
    public function load(string $url): ?DetailsItem
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