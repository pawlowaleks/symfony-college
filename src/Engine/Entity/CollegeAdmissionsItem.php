<?php

namespace App\Engine\Entity;

class CollegeAdmissionsItem extends AbstractEntity
{
    private ?int $applicants;

    private ?int $acceptanceRate;

    private ?float $averageHsgpa;

    private ?string $gpaBreakdown;

    private ?string $testScores;

    private ?string $deadlines;

    /**
     * @return int|null
     */
    public function getApplicants(): ?int
    {
        return $this->applicants;
    }

    /**
     * @param int|null $applicants
     */
    public function setApplicants(?int $applicants): void
    {
        $this->applicants = $applicants;
    }

    /**
     * @return int|null
     */
    public function getAcceptanceRate(): ?int
    {
        return $this->acceptanceRate;
    }

    /**
     * @param int|null $acceptanceRate
     */
    public function setAcceptanceRate(?int $acceptanceRate): void
    {
        $this->acceptanceRate = $acceptanceRate;
    }

    /**
     * @return float|null
     */
    public function getAverageHsgpa(): ?float
    {
        return $this->averageHsgpa;
    }

    /**
     * @param float|null $averageHsgpa
     */
    public function setAverageHsgpa(?float $averageHsgpa): void
    {
        $this->averageHsgpa = $averageHsgpa;
    }

    /**
     * @return string|null
     */
    public function getGpaBreakdown(): ?string
    {
        return $this->gpaBreakdown;
    }

    /**
     * @param string|null $gpaBreakdown
     */
    public function setGpaBreakdown(?string $gpaBreakdown): void
    {
        $this->gpaBreakdown = $gpaBreakdown;
    }

    /**
     * @return string|null
     */
    public function getTestScores(): ?string
    {
        return $this->testScores;
    }

    /**
     * @param string|null $testScores
     */
    public function setTestScores(?string $testScores): void
    {
        $this->testScores = $testScores;
    }

    /**
     * @return string|null
     */
    public function getDeadlines(): ?string
    {
        return $this->deadlines;
    }

    /**
     * @param string|null $deadlines
     */
    public function setDeadlines(?string $deadlines): void
    {
        $this->deadlines = $deadlines;
    }


}