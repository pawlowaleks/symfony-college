<?php

namespace App\Engine\Entity;

class SubjectItem extends AbstractEntity
{

    private string $title;

    private ?SubjectItem $parentSubjectItem = null;

    private string $url;

    public function asArray(): array
    {
        return [
            $this->getTitle(),
            $this->getUrl(),
            empty($this->getParentSubjectItem()) ? null : $this->getParentSubjectItem()->getTitle()
        ];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return SubjectItem|null
     */
    public function getParentSubjectItem(): ?SubjectItem
    {
        return $this->parentSubjectItem;
    }

    /**
     * @param SubjectItem|null $parentSubjectItem
     */
    public function setParentSubjectItem(?SubjectItem $parentSubjectItem): void
    {
        $this->parentSubjectItem = $parentSubjectItem;
    }


}