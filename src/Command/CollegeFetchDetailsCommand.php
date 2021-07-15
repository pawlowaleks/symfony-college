<?php

namespace App\Command;

use App\Service\CollegeFetchDetailsService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class CollegeFetchDetailsCommand
 * @package App\Command
 */
#[AsCommand(
    name: 'college:fetch-details',
    description: 'Сохранить детальную информацию о колледже',
)]
class CollegeFetchDetailsCommand extends Command
{

    /**
     * @var CollegeFetchDetailsService
     */
    private CollegeFetchDetailsService $collegeFetchDetailsService;

    /**
     * CollegeFetchDetailsCommand constructor.
     * @param CollegeFetchDetailsService $collegeFetchDetailsService
     */
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

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $url = $input->getArgument('url');

        $io->success("php bin/console college:fetch-details {$url}");

        $result = $this->collegeFetchDetailsService->runInConsole($url, $input, $output);
        if (!$result) {
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }

}
