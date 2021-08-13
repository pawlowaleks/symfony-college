<?php

namespace App\Service;

use App\Engine\Engine\SubjectListEngine;
use App\Entity\Subject;
use Symfony\Component\Console\Helper\Table;

class SubjectService extends AbstractService
{
    const START_URL = 'https://www.classcentral.com/subjects';

    public function runInConsole(): bool
    {
        $subjectEngine = new SubjectListEngine();

        $subjectResult = $subjectEngine->load(self::START_URL);

        $table = new Table($this->output);
        $table->setHeaderTitle('Subjects')
//            ->setFooterTitle("Page {$pageCount}")
            ->setHeaders(['Title', 'Url', 'Parent Subject'])
            ->setRows($subjectResult->toArray());
        $table->render();

        foreach ($subjectResult->getSubjectItems() as $subjectItem) {
            $this->entityManager->getRepository(Subject::class)->saveSubjectItem($subjectItem);
        }

        return true;
    }



}