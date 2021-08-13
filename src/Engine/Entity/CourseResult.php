<?php

namespace App\Engine\Entity;

class CourseResult extends AbstractEntity
{

    /**
     * @var CourseItem[] $courseItems
     */
    private array $courseItems;

    private string $urlNext;

    /**
     * @return string
     */
    public function getUrlNext(): string
    {
        return $this->urlNext;
    }

    /**
     * @param string $urlNext
     */
    public function setUrlNext(string $urlNext): void
    {
        $this->urlNext = $urlNext;
    }

    /**
     * @param CourseItem $courseItem
     */
    public function addCourseItem(CourseItem $courseItem): void
    {
        $this->courseItems[] = $courseItem;
    }

    public function toArray(): array
    {
        $array = [];
        foreach ($this->getCourseItems() as $courseItem) {
            $array[] = $courseItem->toArray();
        }
        return $array;
    }

    /**
     * @return CourseItem[]
     */
    public function getCourseItems(): array
    {
        return $this->courseItems;
    }


}