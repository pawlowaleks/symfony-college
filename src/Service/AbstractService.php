<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

abstract class AbstractService
{

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;

    protected InputInterface $input;

    protected OutputInterface $output;

    protected StyleInterface $io;

    /**
     * CollegeFetchListService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param StyleInterface|null $io
     */
    public function setInputOutput(InputInterface $input, OutputInterface $output, ?StyleInterface $io = null): void
    {
        $this->input = $input;
        $this->output = $output;
        $this->io = $io ?? new SymfonyStyle($input, $output);
    }

    /**
     * @return bool
     */
    abstract public function runInConsole(): bool;

}