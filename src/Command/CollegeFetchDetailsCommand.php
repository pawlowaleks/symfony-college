<?php

namespace App\Command;

use App\Service\CollegeFetchDetailsService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'college:fetch-details',
    description: 'Сохранить детальную информацию о колледже',
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
            ->addArgument('url', InputArgument::REQUIRED, 'Ссылка на страницу о колледже');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $url = $input->getArgument('url');

        $io->success("php bin/console college:fetch-details {$url}");

        if (!$this->collegeFetchDetailsService->fetchDetails($url)) {
            $io->error($this->collegeFetchDetailsService->getErrors());
            return Command::FAILURE;
        }


        $table = new Table($output);
        $table
            ->setHeaderTitle('College')
            ->setHeaders(['Title', 'Address', 'Phone', 'Site'])
            ->setRows([$this->collegeFetchDetailsService->getTableRow()]);
        $table->render();

        return Command::SUCCESS;
    }

}
