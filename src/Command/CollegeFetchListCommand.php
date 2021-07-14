<?php

namespace App\Command;

use App\Engine\ListResult;
use App\Service\CollegeFetchDetailsService;
use App\Service\CollegeFetchListService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


#[AsCommand(
    name: 'college:fetch-list',
    description: 'Сохранить список колледжей',
)]
class CollegeFetchListCommand extends Command
{

    private $entityManager;
    private $collegeFetchListService;
    private $collegeFetchDetailsService;

    public function __construct(EntityManagerInterface $entityManager, CollegeFetchListService $collegeFetchListService, CollegeFetchDetailsService $collegeFetchDetailsService)
    {
        $this->entityManager = $entityManager;
        $this->collegeFetchListService = $collegeFetchListService;
        $this->collegeFetchDetailsService = $collegeFetchDetailsService;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('withDetails', null, InputOption::VALUE_NONE, 'Включить сохранение детальной информации');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $startTime = new DateTimeImmutable();
        $startTimeString = $startTime->format('Y-m-d H:i:s');
        $io->text("startTime = {$startTimeString}");

        /** @var bool $withDetails Включить загрузку детальной информации со всех колледжей */
        $withDetails = false;
        if ($input->getOption('withDetails')) {
            $withDetails = true;
        }
        $io->success('php bin/console college:fetch-list');

        /** @var string $url Ссылка на страницу со списком колледжей */
        $url = CollegeFetchListService::URL_START;

        $pageCount = 1;
        while (!empty($url)) {
            $io->info("Page: {$pageCount}\tUrl: {$url}");

            try {
                $this->collegeFetchListService->fetchCollegesFromPage($url);
            } catch (Exception $e) {
                $io->error($e->getMessage());
                return Command::FAILURE;
            }

            $listResult = $this->collegeFetchListService->getListResult();
            if (empty($listResult)) {
                $pageCount++;
                $io->warning('Empty listResult');
                continue;
            }

            $table = new Table($output);
            $table
                ->setHeaderTitle('Colleges')
                ->setFooterTitle("Page {$pageCount}")
                ->setHeaders(ListResult::getTitleLabels())
                ->setRows($listResult->asArray());
            $table->render();

            $url = $listResult->getNextUrl();
            $pageCount++;
        }

//        $totalCount = count($detailsUrls);
//        $io->success("Total colleges: {$totalCount}");
//
//        if ($withDetails) {
//            $io->text('Fetch details');
//            $detailsCount = 1;
//            foreach ($detailsUrls as $detailsUrl) {
//                if (empty($detailsUrl)) {
//                    continue;
//                }
//                $io->text("#{$detailsCount}: {$detailsUrl}");
//                $detailsResult = $this->collegeFetchDetailsService->fetchDetails($detailsUrl);
//                if (!$detailsResult) {
//                    $io->warning("Details error. url={$detailsUrl}");
//                    $io->warning($this->collegeFetchDetailsService->getErrors());
//                }
//                $detailsCount++;
//            }
//        }

//        // Удалить устаревшие колледжи, которых не было в полученном списке
//        $repository = $this->entityManager->getRepository(College::class);
//        $deleteResult = $repository->deleteOldColleges($startTimeString);
//        $io->text("Deleted {$deleteResult} old colleges");

        return Command::SUCCESS;
    }

}
