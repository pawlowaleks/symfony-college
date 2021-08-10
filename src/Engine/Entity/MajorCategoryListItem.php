<?php

namespace App\Engine\Entity;

class MajorCategoryListItem
{

    private string $title;

    private string $url;

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

    public function asArray(): array
    {
        return [
            $this->getTitle(),
            $this->getUrl()
        ];
    }


}