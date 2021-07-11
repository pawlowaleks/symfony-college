<?php

namespace App\Command;

use App\Controller\CollegeController;
use App\Entity\College;
use App\Repository\CollegeRepository;
use App\Service\CollegeFetchDetailsService;
use App\Service\CollegeFetchListService;
use Doctrine\ORM\EntityManager;
use DOMElement;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use Doctrine\ORM\EntityManagerInterface;


#[AsCommand(
    name: 'college:fetch-list',
    description: 'Add a short description for your command',
)]
class CollegeFetchListCommand extends Command
{

    protected function configure(): void
    {
        $this
            ->addOption('withDetails', null, InputOption::VALUE_NONE, 'Включить сохранение детальной информации');
    }


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



    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $startTime = new \DateTimeImmutable();
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

        /** @var array $rows массив Колледжей для вывода в консоли [['title', 'city', 'state', 'image']] */
        $rows = null;

        /** @var array $detailsUrls Массив с ссылками на детали каждого колледжа ['url1', 'url2', 'url3'] */
        $detailsUrls = [];

        $pageCount = 1;
        while (!empty($url)) {
            $io->info("Page: {$pageCount}\tUrl: {$url}");

            if (!$this->collegeFetchListService->fetchCollegesFromPage($url)) {
                $io->error("Error list page {$url}");
                $io->error($this->collegeFetchListService->getErrors());
                return false;
            }
            $url = $this->collegeFetchListService->getNextUrl();
            $rows = $this->collegeFetchListService->getTableRows();

                $table = new Table($output);
                $table
                    ->setHeaderTitle('Colleges')
                    ->setFooterTitle("Page {$pageCount}")
                    ->setHeaders(['Title', 'City', 'State', 'Image'])
                    ->setRows($rows);
                $table->render();

            $detailsUrls = $this->collegeFetchListService->getDetailsUrls();

            $pageCount++;
        }

        $totalCount = count($detailsUrls);
        $io->success("Total colleges: {$totalCount}");

        if ($withDetails) {
            $io->text('Fetch details');
            $detailsCount = 1;
            foreach ($detailsUrls as $detailsUrl) {
                if (empty($detailsUrl)) {
                    continue;
                }
                $io->text("#{$detailsCount}: {$detailsUrl}");
                $detailsResult = $this->collegeFetchDetailsService->fetchDetails($detailsUrl);
                if (!$detailsResult) {
                    $io->warning("Details error. url={$detailsUrl}");
                    $io->warning($this->collegeFetchDetailsService->getErrors());
                }
                $detailsCount++;
            }
        }

        // Удалить устаревшие колледжи, которых не было в полученном списке
        $repository = $this->entityManager->getRepository(College::class);
        $deleteResult = $repository->deleteOldColleges($startTimeString);
        $io->text("Deleted {$deleteResult} old colleges");

        return Command::SUCCESS;
    }

}
