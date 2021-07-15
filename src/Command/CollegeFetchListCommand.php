<?php

namespace App\Command;

use App\Service\CollegeFetchDetailsService;
use App\Service\CollegeFetchListService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


/**
 * Class CollegeFetchListCommand
 * @package App\Command
 */
#[AsCommand(
    name: 'college:fetch-list',
    description: 'Сохранить список колледжей',
)]
class CollegeFetchListCommand extends Command
{

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var CollegeFetchListService
     */
    private CollegeFetchListService $collegeFetchListService;

    /**
     * CollegeFetchListCommand constructor.
     * @param EntityManagerInterface $entityManager
     * @param CollegeFetchListService $collegeFetchListService
     * @param CollegeFetchDetailsService $collegeFetchDetailsService
     */
    public function __construct(EntityManagerInterface $entityManager, CollegeFetchListService $collegeFetchListService, CollegeFetchDetailsService $collegeFetchDetailsService)
    {
        $this->entityManager = $entityManager;
        $this->collegeFetchListService = $collegeFetchListService;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('with-details', null, InputOption::VALUE_NONE, 'Включить сохранение детальной информации');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        /** @var bool $withDetails Включить загрузку детальной информации со всех колледжей */
        $withDetails = false;
        if ($input->getOption('with-details')) {
            $withDetails = true;
        }
        $io->success('php bin/console college:fetch-list');

        $result = $this->collegeFetchListService->runInConsole($withDetails, $input, $output);
        if (!$result) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

}
