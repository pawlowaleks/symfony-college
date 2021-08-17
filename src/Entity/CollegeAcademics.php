<?php

namespace App\Entity;

use App\Repository\CollegeAcademicsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollegeAcademicsRepository::class)
 */
class CollegeAcademics
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=College::class, inversedBy="collegeAcademics", cascade={"persist", "remove"})
     */
    private $college;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $majors;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $degrees;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $prominentAlumni;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollege(): ?College
    {
        return $this->college;
    }

    public function setCollege(?College $college): self
    {
        $this->college = $college;

        return $this;
    }

    public function getMajors(): ?string
    {
        return $this->majors;
    }

    public function setMajors(?string $majors): self
    {
        $this->majors = $majors;

        return $this;
    }

    public function getDegrees(): ?string
    {
        return $this->degrees;
    }

    public function setDegrees(?string $degrees): self
    {
        $this->degrees = $degrees;

        return $this;
    }

    public function getProminentAlumni(): ?string
    {
        return $this->prominentAlumni;
    }

    public function setProminentAlumni(string $prominentAlumni): self
    {
        $this->prominentAlumni = $prominentAlumni;

        return $this;
    }
}
