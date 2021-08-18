<?php

namespace App\Engine\Entity;

/**
 *
 */
class CollegeCareersItem extends AbstractEntity
{

    /**
     * @var int|null
     */
    private ?int $graduateIn4Years;

    /**
     * @var int|null
     */
    private ?int $graduateIn5Years;

    /**
     * @var int|null
     */
    private ?int $graduateIn6Years;

    /**
     * @var bool|null
     */
    private ?bool $onCampusJobInterviewsAvailable;

    /**
     * @var string|null
     */
    private ?string $careerServices;

    /**
     * @var int|null
     */
    private ?int $startingMedianSalaryUpToBachelorsDegreeCompletedOnly;

    /**
     * @var int|null
     */
    private ?int $midCareerMedianSalaryUptoBachelorsDegreeCompletedOnly;

    /**
     * @var int|null
     */
    private ?int $startingMedianSalaryAtLeastBachelorsDegree;

    /**
     * @var int|null
     */
    private ?int $midCareerMedianSalaryAtLeastBachelorsDegree;

    /**
     * @var int|null
     */
    private ?int $percentHighJobMeaning;

    /**
     * @var int|null
     */
    private ?int $percentSTEM;

    /**
     * @var int|null
     */
    private ?int $roiRating;

    /**
     * @return int|null
     */
    public function getGraduateIn4Years(): ?int
    {
        return $this->graduateIn4Years;
    }

    /**
     * @param int|null $graduateIn4Years
     */
    public function setGraduateIn4Years(?int $graduateIn4Years): void
    {
        $this->graduateIn4Years = $graduateIn4Years;
    }

    /**
     * @return int|null
     */
    public function getGraduateIn5Years(): ?int
    {
        return $this->graduateIn5Years;
    }

    /**
     * @param int|null $graduateIn5Years
     */
    public function setGraduateIn5Years(?int $graduateIn5Years): void
    {
        $this->graduateIn5Years = $graduateIn5Years;
    }

    /**
     * @return int|null
     */
    public function getGraduateIn6Years(): ?int
    {
        return $this->graduateIn6Years;
    }

    /**
     * @param int|null $graduateIn6Years
     */
    public function setGraduateIn6Years(?int $graduateIn6Years): void
    {
        $this->graduateIn6Years = $graduateIn6Years;
    }

    /**
     * @return bool|null
     */
    public function getOnCampusJobInterviewsAvailable(): ?bool
    {
        return $this->onCampusJobInterviewsAvailable;
    }

    /**
     * @param bool|null $onCampusJobInterviewsAvailable
     */
    public function setOnCampusJobInterviewsAvailable(?bool $onCampusJobInterviewsAvailable): void
    {
        $this->onCampusJobInterviewsAvailable = $onCampusJobInterviewsAvailable;
    }

    /**
     * @return string|null
     */
    public function getCareerServices(): ?string
    {
        return $this->careerServices;
    }

    /**
     * @param string|null $careerServices
     */
    public function setCareerServices(?string $careerServices): void
    {
        $this->careerServices = $careerServices;
    }

    /**
     * @return int|null
     */
    public function getStartingMedianSalaryUpToBachelorsDegreeCompletedOnly(): ?int
    {
        return $this->startingMedianSalaryUpToBachelorsDegreeCompletedOnly;
    }

    /**
     * @param int|null $startingMedianSalaryUpToBachelorsDegreeCompletedOnly
     */
    public function setStartingMedianSalaryUpToBachelorsDegreeCompletedOnly(?int $startingMedianSalaryUpToBachelorsDegreeCompletedOnly): void
    {
        $this->startingMedianSalaryUpToBachelorsDegreeCompletedOnly = $startingMedianSalaryUpToBachelorsDegreeCompletedOnly;
    }

    /**
     * @return int|null
     */
    public function getMidCareerMedianSalaryUptoBachelorsDegreeCompletedOnly(): ?int
    {
        return $this->midCareerMedianSalaryUptoBachelorsDegreeCompletedOnly;
    }

    /**
     * @param int|null $midCareerMedianSalaryUptoBachelorsDegreeCompletedOnly
     */
    public function setMidCareerMedianSalaryUptoBachelorsDegreeCompletedOnly(?int $midCareerMedianSalaryUptoBachelorsDegreeCompletedOnly): void
    {
        $this->midCareerMedianSalaryUptoBachelorsDegreeCompletedOnly = $midCareerMedianSalaryUptoBachelorsDegreeCompletedOnly;
    }

    /**
     * @return int|null
     */
    public function getStartingMedianSalaryAtLeastBachelorsDegree(): ?int
    {
        return $this->startingMedianSalaryAtLeastBachelorsDegree;
    }

    /**
     * @param int|null $startingMedianSalaryAtLeastBachelorsDegree
     */
    public function setStartingMedianSalaryAtLeastBachelorsDegree(?int $startingMedianSalaryAtLeastBachelorsDegree): void
    {
        $this->startingMedianSalaryAtLeastBachelorsDegree = $startingMedianSalaryAtLeastBachelorsDegree;
    }

    /**
     * @return int|null
     */
    public function getMidCareerMedianSalaryAtLeastBachelorsDegree(): ?int
    {
        return $this->midCareerMedianSalaryAtLeastBachelorsDegree;
    }

    /**
     * @param int|null $midCareerMedianSalaryAtLeastBachelorsDegree
     */
    public function setMidCareerMedianSalaryAtLeastBachelorsDegree(?int $midCareerMedianSalaryAtLeastBachelorsDegree): void
    {
        $this->midCareerMedianSalaryAtLeastBachelorsDegree = $midCareerMedianSalaryAtLeastBachelorsDegree;
    }

    /**
     * @return int|null
     */
    public function getPercentHighJobMeaning(): ?int
    {
        return $this->percentHighJobMeaning;
    }

    /**
     * @param int|null $percentHighJobMeaning
     */
    public function setPercentHighJobMeaning(?int $percentHighJobMeaning): void
    {
        $this->percentHighJobMeaning = $percentHighJobMeaning;
    }

    /**
     * @return int|null
     */
    public function getPercentSTEM(): ?int
    {
        return $this->percentSTEM;
    }

    /**
     * @param int|null $percentSTEM
     */
    public function setPercentSTEM(?int $percentSTEM): void
    {
        $this->percentSTEM = $percentSTEM;
    }

    /**
     * @return int|null
     */
    public function getRoiRating(): ?int
    {
        return $this->roiRating;
    }

    /**
     * @param int|null $roiRating
     */
    public function setRoiRating(?int $roiRating): void
    {
        $this->roiRating = $roiRating;
    }


}