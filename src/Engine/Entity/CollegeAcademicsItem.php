<?php

namespace App\Engine\Entity;

class CollegeAcademicsItem extends AbstractEntity
{

    /**
     * @var string|null
     */
    private ?string $majors;

    /**
     * @var string|null
     */
    private ?string $degrees;

    /**
     * @var string|null
     */
    private ?string $prominentAlumni;

    /**
     * @return string|null
     */
    public function getMajors(): ?string
    {
        return $this->majors;
    }

    /**
     * @param string|null $majors
     */
    public function setMajors(?string $majors): void
    {
        $this->majors = $majors;
    }

    /**
     * @return string|null
     */
    public function getDegrees(): ?string
    {
        return $this->degrees;
    }

    /**
     * @param string|null $degrees
     */
    public function setDegrees(?string $degrees): void
    {
        $this->degrees = $degrees;
    }

    /**
     * @return string|null
     */
    public function getProminentAlumni(): ?string
    {
        return $this->prominentAlumni;
    }

    /**
     * @param string|null $prominentAlumni
     */
    public function setProminentAlumni(?string $prominentAlumni): void
    {
        $this->prominentAlumni = $prominentAlumni;
    }


}