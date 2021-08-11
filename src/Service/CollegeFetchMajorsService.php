<?php

namespace App\Service;

use App\Engine\College\MajorCategoryEngine;
use App\Engine\College\MajorDetailsEngine;
use App\Engine\Entity\MajorCategoryListItem;
use App\Entity\Major;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Class CollegeFetchMajorsService
 * @package App\Service
 */
class CollegeFetchMajorsService
{

    public const URL_START = 'https://www.princetonreview.com/majors?ceid=nav-1-es';

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
     * @param CollegeFetchListService $collegeFetchListService
     */
    public function __construct(EntityManagerInterface $entityManager, CollegeFetchListService $collegeFetchListService)
    {
        $this->entityManager = $entityManager;
        $this->collegeFetchListService = $collegeFetchListService;
//        parent::__construct();
    }

    public function runInConsole(InputInterface $input, OutputInterface $output): bool
    {
        $io = new SymfonyStyle($input, $output);

        $io->info('F');

        $majorCategoryEngine = new MajorCategoryEngine(HttpClient::create());

        $result = $majorCategoryEngine->load(self::URL_START);


        $table = new Table($output);
        $table->setHeaderTitle('Majors')
            ->setHeaders(['Title', 'Url'])
            ->setRows($result->asArray());
        $table->render();

        /** @var MajorCategoryListItem $majorItem */
        foreach ($result->getItems() as $majorItem) {

            $majorRepository = $this->entityManager->getRepository(Major::class);
            $majorRepository->saveMajorDetails($majorItem);


            $innerResult = $majorCategoryEngine->load($majorItem->getUrl(), $majorItem);
            $table = new Table($output);
            $table->setHeaderTitle('Inner Majors')
                ->setHeaders(['Title', 'Url'])
                ->setRows($innerResult->asArray());
            $table->render();

            /** @var MajorCategoryListItem $innerMajorItem */
            foreach ($innerResult->getItems() as $innerMajorItem) {

                $majorRepository = $this->entityManager->getRepository(Major::class);
                $majorRepository->saveMajorDetails($innerMajorItem);

//                $this->loadColleges($innerMajorItem->getUrl(), $input, $output);
            }
        }

        return true;
    }

    private function loadColleges(string $majorDetailsUrl, InputInterface $input, OutputInterface $output)
    {

        $majorDetailsEngine = new MajorDetailsEngine(HttpClient::create());
        $majorDetailsItem = $majorDetailsEngine->load($majorDetailsUrl);

        $this->collegeFetchListService->runInConsole(false, $input, $output, $majorDetailsItem->getCollegesUrl());
    }


}