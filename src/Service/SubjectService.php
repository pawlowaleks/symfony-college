<?php

namespace App\Service;

use App\Engine\Engine\SubjectListEngine;
use Symfony\Component\Console\Helper\Table;

class SubjectService extends AbstractService
{
    const START_URL = 'https://www.classcentral.com/subjects';

    public function runInConsole(): bool
    {
        $subjectEngine = new SubjectListEngine();

        $subjectResult = $subjectEngine->load(self::START_URL);

        $table = new Table($this->output);
        $table->setHeaderTitle('Colleges')
//            ->setFooterTitle("Page {$pageCount}")
            ->setHeaders(['Title', 'Url', 'Parent Subject'])
            ->setRows($subjectResult->toArray());
        $table->render();

        return true;
    }

}