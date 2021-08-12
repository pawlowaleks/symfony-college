<?php

namespace App\Engine\Entity;

class SubjectResult extends AbstractEntity
{

//    private ?Subject $patentSubject = null;

    /**
     * @var SubjectItem[] $subjectItems
     */
    private array $subjectItems;

    /**
     * @param SubjectItem $subjectItem
     */
    public function addSubjectItem(SubjectItem $subjectItem): void
    {
//        $subjectItem->setParentSubject($this->getPatentSubject());
        $this->subjectItems[] = $subjectItem;
    }

    public function toArray(): array
    {
        $array = [];
        foreach ($this->getSubjectItems() as $subjectItem) {
            $array[] = $subjectItem->asArray();
        }
        return $array;
    }

//    /**
//     * @return Subject|null
//     */
//    public function getPatentSubject(): ?Subject
//    {
//        return $this->patentSubject;
//    }
//
//    /**
//     * @param Subject|null $patentSubject
//     */
//    public function setPatentSubject(?Subject $patentSubject): void
//    {
//        $this->patentSubject = $patentSubject;
//    }

    /**
     * @return SubjectItem[]
     */
    public function getSubjectItems(): array
    {
        return $this->subjectItems;
    }

}