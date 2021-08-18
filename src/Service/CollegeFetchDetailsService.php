<?php


namespace App\Service;


use App\Engine\Engine\CollegeDetailsEngine;
use App\Engine\Entity\CollegeDetailsItem;
use App\Entity\College;
use Exception;
use Symfony\Component\Console\Helper\Table;

/**
 * Class CollegeFetchDetailsService
 * @package App\Service
 */
class CollegeFetchDetailsService extends AbstractService
{
    /**
     * @var CollegeDetailsItem|null
     */
    private ?CollegeDetailsItem $detailsItem;

    /**
     * Запустить в консоли
     * @param string|null $url
     * @return bool
     */
    public function runInConsole(string $url = null): bool
    {
        if (empty($url)) {
            return false;
        }

        $io = $this->io;

        try {
            $this->fetchDetails($url);
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return false;
        }

        $detailsItem = $this->getDetailsItem();
        if (empty($detailsItem)) {
            $io->error('Empty detailsItem');
            return false;
        }

        $table = new Table($this->output);
        $table->setHeaderTitle('College')
            ->setHeaders(CollegeDetailsItem::getTitleLabels())
            ->setRows([$detailsItem->toArray()]);
        $table->render();

        $collegeCareersItem = $detailsItem->getCollegeCareersItem();
        if (isset($collegeCareersItem)) {
            $table = new Table($this->output);
            $table->setHeaderTitle('College Careers')
//                ->setHeaders(CollegeDetailsItem::getTitleLabels())
                ->setRows([$collegeCareersItem->toArray()]);
            $table->render();
        }


        return true;
    }

    /**
     * @param string $url Url с детальной информацией о колледже
     * @return bool
     */
    public function fetchDetails(string $url): bool
    {
        $detailsEngine = new CollegeDetailsEngine();
        $detailsItem = $detailsEngine->load($url);
        $this->setDetailsItem($detailsItem);

        $this->saveCollege();

        return true;
    }

    /**
     * @return bool
     */
    private function saveCollege(): bool
    {
        $collegeRepository = $this->entityManager->getRepository(College::class);
        $collegeRepository->saveCollegeDetails($this->getDetailsItem());
        return true;
    }

    /**
     * @return CollegeDetailsItem|null
     */
    public function getDetailsItem(): ?CollegeDetailsItem
    {
        return $this->detailsItem;
    }

    /**
     * @param CollegeDetailsItem|null $detailsItem
     */
    public function setDetailsItem(?CollegeDetailsItem $detailsItem): void
    {
        $this->detailsItem = $detailsItem;
    }

}