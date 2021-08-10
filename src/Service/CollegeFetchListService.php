<?php


namespace App\Service;


use App\Engine\College\ListEngine;
use App\Engine\College\ListParser;
use App\Engine\Entity\ListResult;
use App\Entity\College;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Class CollegeFetchListService
 * @package App\Service
 */
class CollegeFetchListService
{

    public const URL_START = 'https://www.princetonreview.com/college-search?ceid=cp-1022984';

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var ListResult|null
     */
    private ?ListResult $listResult;

    /**
     * CollegeFetchListService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Запустить в консоли
     * @param bool $withDetails
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return bool
     */
    public function runInConsole(bool $withDetails, InputInterface $input, OutputInterface $output, string $startUrl = self::URL_START): bool
    {
        $io = new SymfonyStyle($input, $output);

        $startTime = new DateTimeImmutable();
        $startTimeString = $startTime->format('Y-m-d H:i:s');
        $io->text("startTime = {$startTimeString}");

        /** @var string $url Ссылка на страницу со списком колледжей */
        $url = $startUrl;

        $detailsUrls = [];
        $detailsUrlsMerged = [];
        $pageCount = 1;
        while (!empty($url)) {
            $io->info("Page: {$pageCount}\tUrl: {$url}");

            try {
                $this->fetchCollegesFromPage($url);
            } catch (Exception $e) {
                $io->error($e->getMessage());
                return Command::FAILURE;
            }

            $listResult = $this->getListResult();
            if (empty($listResult)) {
                $pageCount++;
                $io->warning('Empty listResult');
                continue;
            }

            $table = new Table($output);
            $table->setHeaderTitle('Colleges')
                ->setFooterTitle("Page {$pageCount}")
                ->setHeaders(ListResult::getTitleLabels())
                ->setRows($listResult->asArray());
            $table->render();

//            $detailsUrls = array_merge($detailsUrls, $listResult->getDetailUrls());
            $detailsUrls[] = $listResult->getDetailUrls();

            $url = $listResult->getNextUrl();
            $pageCount++;
        }

        $detailsUrlsMerged = array_merge([], ...$detailsUrls);

        $totalCount = count($detailsUrlsMerged);
        $io->success("Total colleges: {$totalCount}");

        if ($withDetails) {
            $io->text('Fetch details');
            $collegeFetchDetailsService = new CollegeFetchDetailsService($this->entityManager);
            $detailsCount = 1;
            foreach ($detailsUrlsMerged as $detailsUrl) {
                if (empty($detailsUrl)) {
                    continue;
                }
                $io->text("#{$detailsCount}: {$detailsUrl}");

                $detailsResult = $collegeFetchDetailsService->runInConsole($detailsUrl, $input, $output);
                if (!$detailsResult) {
                    continue;
                }
                $detailsCount++;
            }
        }

        // Удалить устаревшие колледжи, которых не было в полученном списке
        $repository = $this->entityManager->getRepository(College::class);
        $deleteResult = $repository->deleteOldColleges($startTimeString);
        $io->text("Deleted {$deleteResult} old colleges");

        return true;
    }

    /**
     * Получить Колледжи с сайта
     * @param string $url url сайта со страницей со списком колледжей
     * @return bool
     */
    public function fetchCollegesFromPage(string $url): bool
    {

        $listEngine = new ListEngine(new ListParser(), HttpClient::create());
        $listResult = $listEngine->load($url);
        if (empty($listResult)) {
            return false;
        }
        $this->setListResult($listResult);

        $this->saveColleges();

        return true;
    }

    /**
     * @return bool
     */
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

}