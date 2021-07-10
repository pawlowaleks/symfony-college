<?php

namespace App\Command;

use App\Service\CollegeFetchDetailsService;
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

#[AsCommand(
    name: 'college:fetch-details',
    description: 'Add a short description for your command',
)]
class CollegeFetchDetailsCommand extends Command
{

    private $collegeFetchDetailsService;

    public function __construct(CollegeFetchDetailsService $collegeFetchDetailsService)
    {
        $this->collegeFetchDetailsService = $collegeFetchDetailsService;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

//        $url = 'https://www.princetonreview.com/college/harvard-college-1022984?ceid=cp-1022984';
        $url = 'https://www.princetonreview.com/college/colby-college-1023880?ceid=cp-1022984';


        $this->collegeFetchDetailsService->fetchDetails($url);

        $debug = true;
        if ($debug) {
            $table = new Table($output);
            $table
                ->setHeaderTitle('College')
                ->setHeaders(['Title', 'Address', 'Phone', 'Site'])
                ->setRows([$this->collegeFetchDetailsService->getTableRow()]);
            $table->render();
        }

        return Command::SUCCESS;
    }

}
