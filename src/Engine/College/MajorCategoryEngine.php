<?php

namespace App\Engine\College;

use App\Engine\Entity\MajorCategoryListResult;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MajorCategoryEngine
{
    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $client;

    /**
     * DetailsEngine constructor.
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function load(string $url): ?MajorCategoryListResult
    {
        $response = $this->client->request('GET', $url);
        if ($response->getStatusCode() != 200) {
//                $this->errors[] = "Error connect to {$url}";
            return null;
        }
        $content = $response->getContent();

        $parser = new MajorCategoryParser();
        return $parser->parse($url, $content);
    }

}