<?php

namespace App\Engine\Entity;

/**
 *
 */
class CollegeTuitionItem extends AbstractEntity
{

    /**
     * @var string|null
     */
    private ?string $dates;

    /**
     * @var string|null
     */
    private ?string $requiredForms;

    /**
     * @var string|null
     */
    private ?string $financialAidStatistics;

    /**
     * @var string|null
     */
    private ?string $expensesPerAcademicYear;

    /**
     * @var string|null
     */
    private ?string $availableAid;

    /**
     * @return string|null
     */
    public function getDates(): ?string
    {
        return $this->dates;
    }

    /**
     * @param string|null $dates
     */
    public function setDates(?string $dates): void
    {
        $this->dates = $dates;
    }

    /**
     * @return string|null
     */
    public function getRequiredForms(): ?string
    {
        return $this->requiredForms;
    }

    /**
     * @param string|null $requiredForms
     */
    public function setRequiredForms(?string $requiredForms): void
    {
        $this->requiredForms = $requiredForms;
    }

    /**
     * @return string|null
     */
    public function getFinancialAidStatistics(): ?string
    {
        return $this->financialAidStatistics;
    }

    /**
     * @param string|null $financialAidStatistics
     */
    public function setFinancialAidStatistics(?string $financialAidStatistics): void
    {
        $this->financialAidStatistics = $financialAidStatistics;
    }

    /**
     * @return string|null
     */
    public function getExpensesPerAcademicYear(): ?string
    {
        return $this->expensesPerAcademicYear;
    }

    /**
     * @param string|null $expensesPerAcademicYear
     */
    public function setExpensesPerAcademicYear(?string $expensesPerAcademicYear): void
    {
        $this->expensesPerAcademicYear = $expensesPerAcademicYear;
    }

    /**
     * @return string|null
     */
    public function getAvailableAid(): ?string
    {
        return $this->availableAid;
    }

    /**
     * @param string|null $availableAid
     */
    public function setAvailableAid(?string $availableAid): void
    {
        $this->availableAid = $availableAid;
    }

}