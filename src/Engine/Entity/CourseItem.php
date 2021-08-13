<?php

namespace App\Engine\Entity;

class CourseItem extends AbstractEntity
{
    private $title;
    private $urlDetails;

    private ?SubjectItem $subjectItem;

    public function toArray(): array
    {
        return [
            $this->getTitle(),
            $this->getUrlDetails(),
            empty($this->subjectItem) ? null : $this->getSubjectItem()->getTitle()
        ];
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getUrlDetails()
    {
        return $this->urlDetails;
    }

    /**
     * @param mixed $urlDetails
     */
    public function setUrlDetails($urlDetails): void
    {
        $this->urlDetails = $urlDetails;
    }

    /**
     * @return SubjectItem|null
     */
    public function getSubjectItem(): ?SubjectItem
    {
        return $this->subjectItem;
    }

    /**
     * @param SubjectItem|null $subjectItem
     */
    public function setSubjectItem(?SubjectItem $subjectItem): void
    {
        $this->subjectItem = $subjectItem;
    }


}