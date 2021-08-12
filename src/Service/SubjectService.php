<?php

namespace App\Service;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SubjectService
{

    public function runInConsole(InputInterface $input, OutputInterface $output): bool
    {
        $io = new SymfonyStyle($input, $output);

//        $subjectEngine = new SubjectListEngine();

        return true;
    }

    public function load(): bool
    {

        return true;
    }

}