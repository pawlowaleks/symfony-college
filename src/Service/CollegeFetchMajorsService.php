<?php

namespace App\Service;

use App\Engine\College\MajorCategoryEngine;
use App\Engine\Entity\MajorCategoryListItem;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;

class CollegeFetchMajorsService
{

    public const URL_START = 'https://www.princetonreview.com/majors?ceid=nav-1-es';

    public function runInConsole(InputInterface $input, OutputInterface $output): bool
    {
        $io = new SymfonyStyle($input, $output);

        $io->info('F');

        $majorCategoryEngine = new MajorCategoryEngine(HttpClient::create());

        $result = $majorCategoryEngine->load(self::URL_START);


        $table = new Table($output);
        $table->setHeaderTitle('Majors')
//            ->setFooterTitle("Page {$pageCount}")
            ->setHeaders(['Title', 'Url'])
            ->setRows($result->asArray());
        $table->render();

        /** @var MajorCategoryListItem $majorItem */
        foreach ($result->getItems() as $majorItem) {

            $innerResult = $majorCategoryEngine->load($majorItem->getUrl());

            $table = new Table($output);
            $table->setHeaderTitle('Inner Majors')
//            ->setFooterTitle("Page {$pageCount}")
                ->setHeaders(['Title', 'Url'])
                ->setRows($innerResult->asArray());
            $table->render();
        }

        return true;
    }

}