<?php


namespace App\Service;


use App\Engine\College\DetailsEngine;
use App\Engine\College\DetailsParser;
use App\Engine\DetailsItem;
use App\Entity\College;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;

class CollegeFetchDetailsService
{
    /**
     * @var DetailsItem|null
     */
    private ?DetailsItem $detailsItem;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return DetailsItem|null
     */
    public function getDetailsItem(): ?DetailsItem
    {
        return $this->detailsItem;
    }

    /**
     * @param DetailsItem|null $detailsItem
     */
    public function setDetailsItem(?DetailsItem $detailsItem): void
    {
        $this->detailsItem = $detailsItem;
    }

    /**
     * @param string $url Url с детальной информацией о колледже
     * @return bool
     */
    public function fetchDetails(string $url): bool
    {
        $detailsEngine = new DetailsEngine(new DetailsParser(), HttpClient::create());
        $detailsItem = $detailsEngine->load($url);
        $this->setDetailsItem($detailsItem);

        $this->saveCollege();

        return true;
    }

    private function saveCollege(): bool
    {
        $collegeRepository = $this->entityManager->getRepository(College::class);
        $collegeRepository->saveCollegeDetails($this->getDetailsItem());
        return true;
    }


}