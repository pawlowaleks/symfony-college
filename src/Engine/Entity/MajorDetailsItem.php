<?php

namespace App\Engine\Entity;

class MajorDetailsItem
{

    private $collegesUrl;

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