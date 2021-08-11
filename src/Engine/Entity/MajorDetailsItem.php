<?php

namespace App\Engine\Entity;

class MajorDetailsItem
{

    private string $collegesUrl;

    private ?MajorDetailsItem $parentMajor;

    /**
     * @return MajorDetailsItem|null
     */
    public function getParentMajor(): ?MajorDetailsItem
    {
        return $this->parentMajor;
    }

    /**
     * @param MajorDetailsItem|null $parentMajor
     */
    public function setParentMajor(?MajorDetailsItem $parentMajor): void
    {
        $this->parentMajor = $parentMajor;
    }


    /**
     * @return mixed
     */
    public function getCollegesUrl()
    {
        return $this->collegesUrl;
    }

    /**
     * @param mixed $collegesUrl
     */
    public function setCollegesUrl($collegesUrl): void
    {
        $this->collegesUrl = $collegesUrl;
    }

}