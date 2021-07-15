<?php


namespace App\Service;


use App\Engine\College\DetailsEngine;
use App\Engine\College\DetailsParser;
use App\Engine\Entity\DetailsItem;
use App\Entity\College;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Class CollegeFetchDetailsService
 * @package App\Service
 */
class CollegeFetchDetailsService
{
    /**
     * @var DetailsItem|null
     */
    private ?DetailsItem $detailsItem;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CollegeFetchDetailsService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Запустить в консоли
     * @param string $url
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return bool
     */
    public function runInConsole(string $url, InputInterface $input, OutputInterface $output): bool
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->fetchDetails($url);
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return false;
        }

        $detailsItem = $this->getDetailsItem();
        if (empty($detailsItem)) {
            $io->error('Empty detailsItem');
            return false;
        }

        $table = new Table($output);
        $table
            ->setHeaderTitle('College')
            ->setHeaders(DetailsItem::getTitleLabels())
            ->setRows([$detailsItem->asArray()]);
        $table->render();
        return true;
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

    /**
     * @return bool
     */
    private function saveCollege(): bool
    {
        $collegeRepository = $this->entityManager->getRepository(College::class);
        $collegeRepository->saveCollegeDetails($this->getDetailsItem());
        return true;
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

}