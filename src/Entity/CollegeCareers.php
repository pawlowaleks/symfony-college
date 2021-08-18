<?php

namespace App\Entity;

use App\Repository\CollegeCareersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollegeCareersRepository::class)
 */
class CollegeCareers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=College::class, inversedBy="collegeCareers", cascade={"persist", "remove"})
     */
    private $college;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $graduateIn4Years;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $graduateIn5Years;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $graduateIn6Years;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $onCampusJobInterviewsAvailable;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $careerServices;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $startingMedianSalaryUpToBachelorsDegreeCompletedOnly;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $midCareerMedianSalaryUptoBachelorsDegreeCompletedOnly;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $startingMedianSalaryAtLeastBachelorsDegree;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $midCareerMedianSalaryAtLeastBachelorsDegree;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $percentHighJobMeaning;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $percentSTEM;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $roiRating;

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

    public function getGraduateIn4Years(): ?int
    {
        return $this->graduateIn4Years;
    }

    public function setGraduateIn4Years(?int $graduateIn4Years): self
    {
        $this->graduateIn4Years = $graduateIn4Years;

        return $this;
    }

    public function getGraduateIn5Years(): ?int
    {
        return $this->graduateIn5Years;
    }

    public function setGraduateIn5Years(?int $graduateIn5Years): self
    {
        $this->graduateIn5Years = $graduateIn5Years;

        return $this;
    }

    public function getGraduateIn6Years(): ?int
    {
        return $this->graduateIn6Years;
    }

    public function setGraduateIn6Years(?int $graduateIn6Years): self
    {
        $this->graduateIn6Years = $graduateIn6Years;

        return $this;
    }

    public function getOnCampusJobInterviewsAvailable(): ?bool
    {
        return $this->onCampusJobInterviewsAvailable;
    }

    public function setOnCampusJobInterviewsAvailable(?bool $onCampusJobInterviewsAvailable): self
    {
        $this->onCampusJobInterviewsAvailable = $onCampusJobInterviewsAvailable;

        return $this;
    }

    public function getCareerServices(): ?string
    {
        return $this->careerServices;
    }

    public function setCareerServices(?string $careerServices): self
    {
        $this->careerServices = $careerServices;

        return $this;
    }

    public function getStartingMedianSalaryUpToBachelorsDegreeCompletedOnly(): ?int
    {
        return $this->startingMedianSalaryUpToBachelorsDegreeCompletedOnly;
    }

    public function setStartingMedianSalaryUpToBachelorsDegreeCompletedOnly(?int $startingMedianSalaryUpToBachelorsDegreeCompletedOnly): self
    {
        $this->startingMedianSalaryUpToBachelorsDegreeCompletedOnly = $startingMedianSalaryUpToBachelorsDegreeCompletedOnly;

        return $this;
    }

    public function getMidCareerMedianSalaryUptoBachelorsDegreeCompletedOnly(): ?int
    {
        return $this->midCareerMedianSalaryUptoBachelorsDegreeCompletedOnly;
    }

    public function setMidCareerMedianSalaryUptoBachelorsDegreeCompletedOnly(?int $midCareerMedianSalaryUptoBachelorsDegreeCompletedOnly): self
    {
        $this->midCareerMedianSalaryUptoBachelorsDegreeCompletedOnly = $midCareerMedianSalaryUptoBachelorsDegreeCompletedOnly;

        return $this;
    }

    public function getStartingMedianSalaryAtLeastBachelorsDegree(): ?int
    {
        return $this->startingMedianSalaryAtLeastBachelorsDegree;
    }

    public function setStartingMedianSalaryAtLeastBachelorsDegree(?int $startingMedianSalaryAtLeastBachelorsDegree): self
    {
        $this->startingMedianSalaryAtLeastBachelorsDegree = $startingMedianSalaryAtLeastBachelorsDegree;

        return $this;
    }

    public function getMidCareerMedianSalaryAtLeastBachelorsDegree(): ?int
    {
        return $this->midCareerMedianSalaryAtLeastBachelorsDegree;
    }

    public function setMidCareerMedianSalaryAtLeastBachelorsDegree(?int $midCareerMedianSalaryAtLeastBachelorsDegree): self
    {
        $this->midCareerMedianSalaryAtLeastBachelorsDegree = $midCareerMedianSalaryAtLeastBachelorsDegree;

        return $this;
    }

    public function getPercentHighJobMeaning(): ?int
    {
        return $this->percentHighJobMeaning;
    }

    public function setPercentHighJobMeaning(?int $percentHighJobMeaning): self
    {
        $this->percentHighJobMeaning = $percentHighJobMeaning;

        return $this;
    }

    public function getPercentSTEM(): ?int
    {
        return $this->percentSTEM;
    }

    public function setPercentSTEM(?int $percentSTEM): self
    {
        $this->percentSTEM = $percentSTEM;

        return $this;
    }

    public function getRoiRating(): ?int
    {
        return $this->roiRating;
    }

    public function setRoiRating(?int $roiRating): self
    {
        $this->roiRating = $roiRating;

        return $this;
    }
}
