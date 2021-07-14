<?php


namespace App\Service;


use App\Engine\College\ListEngine;
use App\Engine\College\ListParser;
use App\Engine\ListResult;
use App\Entity\College;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;

class CollegeFetchListService
{

    public const URL_START = 'https://www.princetonreview.com/college-search?ceid=cp-1022984';

    private $entityManager;

    /**
     * @var ListResult|null
     */
    private ?ListResult $listResult;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Получить Колледжи с сайта
     * @param string $url url сайта со страницей со списком колледжей
     * @return string|null
     */
    public function fetchCollegesFromPage(string $url): bool
    {

        $listEngine = new ListEngine(new ListParser(), HttpClient::create());
        $listResult = $listEngine->load($url);
        if (empty($listResult)) {
            return false;
        }
        $this->setListResult($listResult);

        $this->setNextUrl($listResult->getNextUrl());

        $this->saveColleges();

        return true;
    }

    private function saveColleges(): bool
    {
        $collegeRepository = $this->entityManager->getRepository(College::class);
        foreach ($this->getListResult() as $listItem) {
            $collegeRepository->saveCollege($listItem);
        }
        return true;
    }

    /**
     * @return ListResult|null
     */
    public function getListResult(): ?ListResult
    {
        return $this->listResult;
    }

    /**
     * @param ListResult|null $listResult
     */
    public function setListResult(?ListResult $listResult): void
    {
        $this->listResult = $listResult;
    }

    /**
     * @param string|null $nextUrl
     */
    public function setNextUrl(?string $nextUrl): void
    {
        $this->nextUrl = $nextUrl;
    }

}