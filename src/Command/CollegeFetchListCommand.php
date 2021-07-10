<?php

namespace App\Command;

use App\Controller\CollegeController;
use App\Entity\College;
use App\Repository\CollegeRepository;
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
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('debug', null, InputOption::VALUE_NONE, 'Включить вывод Колледжей')
        ;
    }



    private $collegeFetchService;

    public function __construct(CollegeFetchListService $collegeFetchService)
    {

        $this->collegeFetchService = $collegeFetchService;

        parent::__construct();
    }



    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $debug = false;
//        $debugArgument = $input->getArgument('debug');
//
//        if ($debugArgument) {
//            $io->note(sprintf('You passed an argument: %s', $debugArgument));
//            $debug = true;
//        }

        if ($input->getOption('debug')) {
            $debug = true;
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');


        $url = CollegeFetchListService::URL_START;

        $pageCount = 1;
        while (!empty($url)) {
            $io->info("Page: {$pageCount}\tUrl: {$url}");

            $this->collegeFetchService->fetchCollegesFromPage($url, true);

            $url = $this->collegeFetchService->getNextUrl();

            $rows = $this->collegeFetchService->getTableRows();

            if ($debug) {
                $table = new Table($output);
                $table
                    ->setHeaderTitle('Colleges')
                    ->setFooterTitle("Page {$pageCount}")
                    ->setHeaders(['Title', 'City', 'State', 'Image'])
                    ->setRows($rows);
                $table->render();
            }

            // TODO: remove
            break;

            $pageCount++;
        }

        return Command::SUCCESS;
    }

}
