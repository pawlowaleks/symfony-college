<?php


namespace App\Service;


use App\Engine\College\ListEngine;
use App\Engine\College\ListParser;
use App\Engine\Engine\CollegeListEngine;
use App\Engine\Entity\CollegeListItem;
use App\Engine\Entity\CollegeListResult;
use App\Entity\College;
use App\Entity\Major;
use DateTimeImmutable;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;

/**
 * Class CollegeFetchListService
 * @package App\Service
 */
class CollegeFetchListService extends AbstractService
{

    public const URL_START = 'https://www.princetonreview.com/college-search?ceid=cp-1022984';

    /**
     * @var CollegeListResult|null
     */
    private ?CollegeListResult $listResult;

    private ?Major $major = null;

    /**
     * @return ?Major
     */
    public function getMajor(): ?Major
    {
        return $this->major;
    }

    /**
     * @param ?Major $major
     */
    public function setMajor(?Major $major): void
    {
        $this->major = $major;
    }

    /**
     * Запустить в консоли
     * @param bool $withDetails
     * @param string $startUrl
     * @param bool $deleteOld
     * @return bool
     */
    public function runInConsole(bool $withDetails = false, string $startUrl = self::URL_START, bool $deleteOld = true): bool
    {
        $io = $this->io;

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

            $table = new Table($this->output);
            $table->setHeaderTitle('Colleges')
                ->setFooterTitle("Page {$pageCount}")
                ->setHeaders(CollegeListResult::getTitleLabels())
                ->setRows($listResult->toArray());
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

                $detailsResult = $collegeFetchDetailsService->runInConsole($detailsUrl, $this->input, $this->output);
                if (!$detailsResult) {
                    continue;
                }
                $detailsCount++;
            }
        }

        if ($deleteOld) {
            // Удалить устаревшие колледжи, которых не было в полученном списке
            $repository = $this->entityManager->getRepository(College::class);
            $deleteResult = $repository->deleteOldColleges($startTimeString);
            $io->text("Deleted {$deleteResult} old colleges");
        }

        return true;
    }

    /**
     * Получить Колледжи с сайта
     * @param string $url url сайта со страницей со списком колледжей
     * @return bool
     */
    public function fetchCollegesFromPage(string $url): bool
    {

        $listEngine = new CollegeListEngine();
        $listResult = $listEngine->load($url, $this->getMajor());
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
        if (empty($this->getListResult())) {
            return false;
        }

        $collegeRepository = $this->entityManager->getRepository(College::class);

        /** @var CollegeListItem $listItem */
        foreach ($this->getListResult()->getItems() as $listItem) {
            $collegeRepository->saveCollege($listItem);
        }
        return true;
    }

    /**
     * @return CollegeListResult|null
     */
    public function getListResult(): ?CollegeListResult
    {
        return $this->listResult;
    }

    /**
     * @param CollegeListResult|null $listResult
     */
    public function setListResult(?CollegeListResult $listResult): void
    {
        $this->listResult = $listResult;
    }

}