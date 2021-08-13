<?php

namespace App\Service;

use App\Engine\Engine\CourseEngine;
use App\Engine\Entity\SubjectItem;
use App\Entity\Course;
use Symfony\Component\Console\Helper\Table;

class CourseService extends AbstractService
{

    public const URL_START = 'https://www.classcentral.com/subject/ai';


    public function runInConsole(string $url = null, SubjectItem $subjectItem = null): bool
    {
        if (empty($url)) {
            $this->io->error('Empty url');
            return false;
        }

        $courseEngine = new CourseEngine();
        $courseResult = $courseEngine->load(self::URL_START, $subjectItem);

        $table = new Table($this->output);
        $table->setHeaderTitle('Courser')
//            ->setFooterTitle("Page {$pageCount}")
            ->setHeaders(['Title', 'Url', 'Subject'])
            ->setRows($courseResult->toArray());
        $table->render();


        foreach ($courseResult->getCourseItems() as $courseItem) {
//            $courseItem->setSubjectItem($subjectItem);
//            $this->io->text($courseItem->getSubjectItem()->getTitle());
            $this->entityManager->getRepository(Course::class)->saveCourseItem($courseItem);
        }

        return true;
    }
}