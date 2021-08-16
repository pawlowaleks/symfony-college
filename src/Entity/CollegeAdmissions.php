<?php

namespace App\Entity;

use App\Repository\CollegeAdmissionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollegeAdmissionsRepository::class)
 */
class CollegeAdmissions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=College::class, inversedBy="collegeAdmissions", cascade={"persist", "remove"})
     */
    private $college;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $applicants;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $acceptansceRate;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $averageHSGPA;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $gpaBreakdown;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $testScores;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $deadlines;

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

    public function getApplicants(): ?int
    {
        return $this->applicants;
    }

    public function setApplicants(?int $applicants): self
    {
        $this->applicants = $applicants;

        return $this;
    }

    public function getAcceptansceRate(): ?int
    {
        return $this->acceptansceRate;
    }

    public function setAcceptansceRate(?int $acceptansceRate): self
    {
        $this->acceptansceRate = $acceptansceRate;

        return $this;
    }

    public function getAverageHSGPA(): ?float
    {
        return $this->averageHSGPA;
    }

    public function setAverageHSGPA(?float $averageHSGPA): self
    {
        $this->averageHSGPA = $averageHSGPA;

        return $this;
    }

    public function getGpaBreakdown(): ?string
    {
        return $this->gpaBreakdown;
    }

    public function setGpaBreakdown(?string $gpaBreakdown): self
    {
        $this->gpaBreakdown = $gpaBreakdown;

        return $this;
    }

    public function getTestScores(): ?string
    {
        return $this->testScores;
    }

    public function setTestScores(?string $testScores): self
    {
        $this->testScores = $testScores;

        return $this;
    }

    public function getDeadlines(): ?string
    {
        return $this->deadlines;
    }

    public function setDeadlines(?string $deadlines): self
    {
        $this->deadlines = $deadlines;

        return $this;
    }
}
