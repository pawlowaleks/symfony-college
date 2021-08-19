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

    private ?string $applicationDeadlines;

    private ?string $notificationDate;

    /**
     * @var string|null
     */
    private ?string $requiredForms;

    /**
     * @var string|null
     */
    private ?string $financialAidStatistics;

    private ?int $averageFreshmanTotalNeedBasedGiftAid;

    private ?int $averageUndergraduateTotalNeedBasedGiftAid;

    private ?int $averageNeedBasedLoan;

    private ?int $undergraduatesWhoHaveBorrowedThroughAnyLoanProgram;

    private ?int $averageAmountOfLoanDebtPerGraduate;

    private ?int $averageAmountOfEachFreshmanScholarshipGrantPackage;

    private ?bool $financialAidProvidedToInternationalStudents;

    /**
     * @var string|null
     */
    private ?string $expensesPerAcademicYear;

    private ?int $tuitionInState;

    private ?int $tuitionOutOfState;

    private ?int $requiredFees;

    private ?int $averageCostForBooksAndSupplies;

    private ?bool $tuitionFeesVaryByYearOfStudy;

    private ?int $boardForCommuters;

    private ?int $transportationForCommuters;

    private ?int $onCampusRoomAndBoard;

    /**
     * @var string|null
     */
    private ?string $availableAid;

    private ?string $financialAidMethodology;

    private ?string $scholarshipsAndGrantsNeedBased;

    private ?string $scholarshipsAndGrantsNonNeedBased;

    private ?string $federalDirectStudentLoanPrograms;

    private ?string $federalFamilyEducationLoanPrograms;

    private ?bool $isInstitutionalEmploymentAvailable;

    private ?bool $directLender;

    /**
     * @return string|null
     */
    public function getApplicationDeadlines(): ?string
    {
        return $this->applicationDeadlines;
    }

    /**
     * @param string|null $applicationDeadlines
     */
    public function setApplicationDeadlines(?string $applicationDeadlines): void
    {
        $this->applicationDeadlines = $applicationDeadlines;
    }

    /**
     * @return string|null
     */
    public function getNotificationDate(): ?string
    {
        return $this->notificationDate;
    }

    /**
     * @param string|null $notificationDate
     */
    public function setNotificationDate(?string $notificationDate): void
    {
        $this->notificationDate = $notificationDate;
    }

    /**
     * @return int|null
     */
    public function getAverageFreshmanTotalNeedBasedGiftAid(): ?int
    {
        return $this->averageFreshmanTotalNeedBasedGiftAid;
    }

    /**
     * @param int|null $averageFreshmanTotalNeedBasedGiftAid
     */
    public function setAverageFreshmanTotalNeedBasedGiftAid(?int $averageFreshmanTotalNeedBasedGiftAid): void
    {
        $this->averageFreshmanTotalNeedBasedGiftAid = $averageFreshmanTotalNeedBasedGiftAid;
    }

    /**
     * @return int|null
     */
    public function getAverageUndergraduateTotalNeedBasedGiftAid(): ?int
    {
        return $this->averageUndergraduateTotalNeedBasedGiftAid;
    }

    /**
     * @param int|null $averageUndergraduateTotalNeedBasedGiftAid
     */
    public function setAverageUndergraduateTotalNeedBasedGiftAid(?int $averageUndergraduateTotalNeedBasedGiftAid): void
    {
        $this->averageUndergraduateTotalNeedBasedGiftAid = $averageUndergraduateTotalNeedBasedGiftAid;
    }

    /**
     * @return int|null
     */
    public function getAverageNeedBasedLoan(): ?int
    {
        return $this->averageNeedBasedLoan;
    }

    /**
     * @param int|null $averageNeedBasedLoan
     */
    public function setAverageNeedBasedLoan(?int $averageNeedBasedLoan): void
    {
        $this->averageNeedBasedLoan = $averageNeedBasedLoan;
    }

    /**
     * @return int|null
     */
    public function getUndergraduatesWhoHaveBorrowedThroughAnyLoanProgram(): ?int
    {
        return $this->undergraduatesWhoHaveBorrowedThroughAnyLoanProgram;
    }

    /**
     * @param int|null $undergraduatesWhoHaveBorrowedThroughAnyLoanProgram
     */
    public function setUndergraduatesWhoHaveBorrowedThroughAnyLoanProgram(?int $undergraduatesWhoHaveBorrowedThroughAnyLoanProgram): void
    {
        $this->undergraduatesWhoHaveBorrowedThroughAnyLoanProgram = $undergraduatesWhoHaveBorrowedThroughAnyLoanProgram;
    }

    /**
     * @return int|null
     */
    public function getAverageAmountOfLoanDebtPerGraduate(): ?int
    {
        return $this->averageAmountOfLoanDebtPerGraduate;
    }

    /**
     * @param int|null $averageAmountOfLoanDebtPerGraduate
     */
    public function setAverageAmountOfLoanDebtPerGraduate(?int $averageAmountOfLoanDebtPerGraduate): void
    {
        $this->averageAmountOfLoanDebtPerGraduate = $averageAmountOfLoanDebtPerGraduate;
    }

    /**
     * @return int|null
     */
    public function getAverageAmountOfEachFreshmanScholarshipGrantPackage(): ?int
    {
        return $this->averageAmountOfEachFreshmanScholarshipGrantPackage;
    }

    /**
     * @param int|null $averageAmountOfEachFreshmanScholarshipGrantPackage
     */
    public function setAverageAmountOfEachFreshmanScholarshipGrantPackage(?int $averageAmountOfEachFreshmanScholarshipGrantPackage): void
    {
        $this->averageAmountOfEachFreshmanScholarshipGrantPackage = $averageAmountOfEachFreshmanScholarshipGrantPackage;
    }

    /**
     * @return bool|null
     */
    public function getFinancialAidProvidedToInternationalStudents(): ?bool
    {
        return $this->financialAidProvidedToInternationalStudents;
    }

    /**
     * @param bool|null $financialAidProvidedToInternationalStudents
     */
    public function setFinancialAidProvidedToInternationalStudents(?bool $financialAidProvidedToInternationalStudents): void
    {
        $this->financialAidProvidedToInternationalStudents = $financialAidProvidedToInternationalStudents;
    }

    /**
     * @return int|null
     */
    public function getTuitionInState(): ?int
    {
        return $this->tuitionInState;
    }

    /**
     * @param int|null $tuitionInState
     */
    public function setTuitionInState(?int $tuitionInState): void
    {
        $this->tuitionInState = $tuitionInState;
    }

    /**
     * @return int|null
     */
    public function getTuitionOutOfState(): ?int
    {
        return $this->tuitionOutOfState;
    }

    /**
     * @param int|null $tuitionOutOfState
     */
    public function setTuitionOutOfState(?int $tuitionOutOfState): void
    {
        $this->tuitionOutOfState = $tuitionOutOfState;
    }

    /**
     * @return int|null
     */
    public function getRequiredFees(): ?int
    {
        return $this->requiredFees;
    }

    /**
     * @param int|null $requiredFees
     */
    public function setRequiredFees(?int $requiredFees): void
    {
        $this->requiredFees = $requiredFees;
    }

    /**
     * @return int|null
     */
    public function getAverageCostForBooksAndSupplies(): ?int
    {
        return $this->averageCostForBooksAndSupplies;
    }

    /**
     * @param int|null $averageCostForBooksAndSupplies
     */
    public function setAverageCostForBooksAndSupplies(?int $averageCostForBooksAndSupplies): void
    {
        $this->averageCostForBooksAndSupplies = $averageCostForBooksAndSupplies;
    }

    /**
     * @return bool|null
     */
    public function getTuitionFeesVaryByYearOfStudy(): ?bool
    {
        return $this->tuitionFeesVaryByYearOfStudy;
    }

    /**
     * @param bool|null $tuitionFeesVaryByYearOfStudy
     */
    public function setTuitionFeesVaryByYearOfStudy(?bool $tuitionFeesVaryByYearOfStudy): void
    {
        $this->tuitionFeesVaryByYearOfStudy = $tuitionFeesVaryByYearOfStudy;
    }

    /**
     * @return int|null
     */
    public function getBoardForCommuters(): ?int
    {
        return $this->boardForCommuters;
    }

    /**
     * @param int|null $boardForCommuters
     */
    public function setBoardForCommuters(?int $boardForCommuters): void
    {
        $this->boardForCommuters = $boardForCommuters;
    }

    /**
     * @return int|null
     */
    public function getTransportationForCommuters(): ?int
    {
        return $this->transportationForCommuters;
    }

    /**
     * @param int|null $transportationForCommuters
     */
    public function setTransportationForCommuters(?int $transportationForCommuters): void
    {
        $this->transportationForCommuters = $transportationForCommuters;
    }

    /**
     * @return int|null
     */
    public function getOnCampusRoomAndBoard(): ?int
    {
        return $this->onCampusRoomAndBoard;
    }

    /**
     * @param int|null $onCampusRoomAndBoard
     */
    public function setOnCampusRoomAndBoard(?int $onCampusRoomAndBoard): void
    {
        $this->onCampusRoomAndBoard = $onCampusRoomAndBoard;
    }

    /**
     * @return string|null
     */
    public function getFinancialAidMethodology(): ?string
    {
        return $this->financialAidMethodology;
    }

    /**
     * @param string|null $financialAidMethodology
     */
    public function setFinancialAidMethodology(?string $financialAidMethodology): void
    {
        $this->financialAidMethodology = $financialAidMethodology;
    }

    /**
     * @return string|null
     */
    public function getScholarshipsAndGrantsNeedBased(): ?string
    {
        return $this->scholarshipsAndGrantsNeedBased;
    }

    /**
     * @param string|null $scholarshipsAndGrantsNeedBased
     */
    public function setScholarshipsAndGrantsNeedBased(?string $scholarshipsAndGrantsNeedBased): void
    {
        $this->scholarshipsAndGrantsNeedBased = $scholarshipsAndGrantsNeedBased;
    }

    /**
     * @return string|null
     */
    public function getScholarshipsAndGrantsNonNeedBased(): ?string
    {
        return $this->scholarshipsAndGrantsNonNeedBased;
    }

    /**
     * @param string|null $scholarshipsAndGrantsNonNeedBased
     */
    public function setScholarshipsAndGrantsNonNeedBased(?string $scholarshipsAndGrantsNonNeedBased): void
    {
        $this->scholarshipsAndGrantsNonNeedBased = $scholarshipsAndGrantsNonNeedBased;
    }

    /**
     * @return string|null
     */
    public function getFederalDirectStudentLoanPrograms(): ?string
    {
        return $this->federalDirectStudentLoanPrograms;
    }

    /**
     * @param string|null $federalDirectStudentLoanPrograms
     */
    public function setFederalDirectStudentLoanPrograms(?string $federalDirectStudentLoanPrograms): void
    {
        $this->federalDirectStudentLoanPrograms = $federalDirectStudentLoanPrograms;
    }

    /**
     * @return string|null
     */
    public function getFederalFamilyEducationLoanPrograms(): ?string
    {
        return $this->federalFamilyEducationLoanPrograms;
    }

    /**
     * @param string|null $federalFamilyEducationLoanPrograms
     */
    public function setFederalFamilyEducationLoanPrograms(?string $federalFamilyEducationLoanPrograms): void
    {
        $this->federalFamilyEducationLoanPrograms = $federalFamilyEducationLoanPrograms;
    }

    /**
     * @return bool|null
     */
    public function getIsInstitutionalEmploymentAvailable(): ?bool
    {
        return $this->isInstitutionalEmploymentAvailable;
    }

    /**
     * @param bool|null $isInstitutionalEmploymentAvailable
     */
    public function setIsInstitutionalEmploymentAvailable(?bool $isInstitutionalEmploymentAvailable): void
    {
        $this->isInstitutionalEmploymentAvailable = $isInstitutionalEmploymentAvailable;
    }

    /**
     * @return bool|null
     */
    public function getDirectLender(): ?bool
    {
        return $this->directLender;
    }

    /**
     * @param bool|null $directLender
     */
    public function setDirectLender(?bool $directLender): void
    {
        $this->directLender = $directLender;
    }

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