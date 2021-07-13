<?php


namespace App\Engine\Colledge;


use App\Engine\DetailsItem;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DetailsEngine
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

    public function load(string $url): ?DetailsItem
    {
        try {
            $response = $this->client->request('GET', $url);
            if ($response->getStatusCode() != 200) {
//                $this->errors[] = "Error connect to {$url}";
                return null;
            }
            $content = $response->getContent();
        } catch (\Throwable $e) {
//            $this->errors[] = $e->getMessage();
            return null;
        }

        return $this->parser->parse($url, $content);
    }

}