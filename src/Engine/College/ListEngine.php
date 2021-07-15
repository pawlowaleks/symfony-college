<?php


namespace App\Engine\College;


use App\Engine\Entity\ListResult;
use App\Engine\Entity\ListResultInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class ListEngine
 * @package App\Engine\College
 */
class ListEngine implements ListEngineInterface
{
    /**
     * @var ListParser
     */
    private $parser;

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * DetailsEngine constructor.
     * @param ListParser $parser
     * @param HttpClientInterface $client
     */
    public function __construct(ListParser $parser, HttpClientInterface $client)
    {
        $this->parser = $parser;
        $this->client = $client;
    }

    /**
     * @param string $url
     * @return ListResult|null
     */
    public function load(string $url): ?ListResultInterface
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