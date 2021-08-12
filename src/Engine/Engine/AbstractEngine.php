<?php

namespace App\Engine\Engine;

use App\Engine\Entity\AbstractEntity;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractEngine implements EngineInterface
{

    /**
     * @var HttpClientInterface
     */
    protected HttpClientInterface $client;

    /**
     * DetailsEngine constructor.
     * @param HttpClientInterface|null $client
     */
    public function __construct(HttpClientInterface $client = null)
    {
        $this->client = $client ?? HttpClient::create();
    }

    /**
     * @param string $url
     * @return AbstractEntity|null
     */
    abstract public function load(string $url): ?AbstractEntity;

}