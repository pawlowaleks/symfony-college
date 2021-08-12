<?php

namespace App\Command;

use App\Service\CollegeFetchMajorsService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'college:fetch-majors',
    description: 'Add a short description for your command',
)]
class CollegeFetchMajorsCommand extends Command
{

    private CollegeFetchMajorsService $collegeFetchMajorsService;

    public function __construct(CollegeFetchMajorsService $collegeFetchMajorsService)
    {
        $this->collegeFetchMajorsService = $collegeFetchMajorsService;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
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

//        $service = new CollegeFetchMajorsService();

        $this->collegeFetchMajorsService->setInputOutput($input, $output, $io);
        $this->collegeFetchMajorsService->runInConsole();

        return Command::SUCCESS;
    }
}
