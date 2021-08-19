<?php

namespace App\Entity;

use App\Repository\CollegeTuitionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollegeTuitionRepository::class)
 */
class CollegeTuition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=College::class, inversedBy="collegeTuition", cascade={"persist", "remove"})
     */
    private $college;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $applicationDeadlines;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notificationDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $requiredForms;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $averageFreshmanTotalNeedBasedGiftAid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $averageUndergraduateTotalNeedBasedGiftAid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $averageNeedBasedLoan;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $undergraduatesWhoHaveBorrowedThroughAnyLoanProgram;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $averageAmountOfLoanDebtPerGraduate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $averageAmountOfEachFreshmanScholarshipGrantPackage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $financialAidProvidedToInternationalStudents;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tuitionInState;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tuitionOutOfState;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $requiredFees;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $averageCostForBooksAndSupplies;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $tuitionFeesVaryByYearOfStudy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $boardForCommuters;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $transportationForCommuters;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $onCampusRoomAndBoard;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $financialAidMethodology;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $scholarshipsAndGrantsNeedBased;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $scholarshipsAndGrantsNonNeedBased;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $federalDirectStudentLoanPrograms;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $federalFamilyEducationLoanPrograms;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isInstitutionalEmploymentAvailable;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $directLender;

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

    public function getApplicationDeadlines(): ?string
    {
        return $this->applicationDeadlines;
    }

    public function setApplicationDeadlines(?string $applicationDeadlines): self
    {
        $this->applicationDeadlines = $applicationDeadlines;

        return $this;
    }

    public function getNotificationDate(): ?string
    {
        return $this->notificationDate;
    }

    public function setNotificationDate(?string $notificationDate): self
    {
        $this->notificationDate = $notificationDate;

        return $this;
    }

    public function getRequiredForms(): ?string
    {
        return $this->requiredForms;
    }

    public function setRequiredForms(?string $requiredForms): self
    {
        $this->requiredForms = $requiredForms;

        return $this;
    }

    public function getAverageFreshmanTotalNeedBasedGiftAid(): ?int
    {
        return $this->averageFreshmanTotalNeedBasedGiftAid;
    }

    public function setAverageFreshmanTotalNeedBasedGiftAid(?int $averageFreshmanTotalNeedBasedGiftAid): self
    {
        $this->averageFreshmanTotalNeedBasedGiftAid = $averageFreshmanTotalNeedBasedGiftAid;

        return $this;
    }

    public function getAverageUndergraduateTotalNeedBasedGiftAid(): ?int
    {
        return $this->averageUndergraduateTotalNeedBasedGiftAid;
    }

    public function setAverageUndergraduateTotalNeedBasedGiftAid(?int $averageUndergraduateTotalNeedBasedGiftAid): self
    {
        $this->averageUndergraduateTotalNeedBasedGiftAid = $averageUndergraduateTotalNeedBasedGiftAid;

        return $this;
    }

    public function getAverageNeedBasedLoan(): ?int
    {
        return $this->averageNeedBasedLoan;
    }

    public function setAverageNeedBasedLoan(?int $averageNeedBasedLoan): self
    {
        $this->averageNeedBasedLoan = $averageNeedBasedLoan;

        return $this;
    }

    public function getUndergraduatesWhoHaveBorrowedThroughAnyLoanProgram(): ?int
    {
        return $this->undergraduatesWhoHaveBorrowedThroughAnyLoanProgram;
    }

    public function setUndergraduatesWhoHaveBorrowedThroughAnyLoanProgram(?int $undergraduatesWhoHaveBorrowedThroughAnyLoanProgram): self
    {
        $this->undergraduatesWhoHaveBorrowedThroughAnyLoanProgram = $undergraduatesWhoHaveBorrowedThroughAnyLoanProgram;

        return $this;
    }

    public function getAverageAmountOfLoanDebtPerGraduate(): ?int
    {
        return $this->averageAmountOfLoanDebtPerGraduate;
    }

    public function setAverageAmountOfLoanDebtPerGraduate(?int $averageAmountOfLoanDebtPerGraduate): self
    {
        $this->averageAmountOfLoanDebtPerGraduate = $averageAmountOfLoanDebtPerGraduate;

        return $this;
    }

    public function getAverageAmountOfEachFreshmanScholarshipGrantPackage(): ?int
    {
        return $this->averageAmountOfEachFreshmanScholarshipGrantPackage;
    }

    public function setAverageAmountOfEachFreshmanScholarshipGrantPackage(?int $averageAmountOfEachFreshmanScholarshipGrantPackage): self
    {
        $this->averageAmountOfEachFreshmanScholarshipGrantPackage = $averageAmountOfEachFreshmanScholarshipGrantPackage;

        return $this;
    }

    public function getFinancialAidProvidedToInternationalStudents(): ?bool
    {
        return $this->financialAidProvidedToInternationalStudents;
    }

    public function setFinancialAidProvidedToInternationalStudents(?bool $financialAidProvidedToInternationalStudents): self
    {
        $this->financialAidProvidedToInternationalStudents = $financialAidProvidedToInternationalStudents;

        return $this;
    }

    public function getTuitionInState(): ?int
    {
        return $this->tuitionInState;
    }

    public function setTuitionInState(?int $tuitionInState): self
    {
        $this->tuitionInState = $tuitionInState;

        return $this;
    }

    public function getTuitionOutOfState(): ?int
    {
        return $this->tuitionOutOfState;
    }

    public function setTuitionOutOfState(?int $tuitionOutOfState): self
    {
        $this->tuitionOutOfState = $tuitionOutOfState;

        return $this;
    }

    public function getRequiredFees(): ?int
    {
        return $this->requiredFees;
    }

    public function setRequiredFees(?int $requiredFees): self
    {
        $this->requiredFees = $requiredFees;

        return $this;
    }

    public function getAverageCostForBooksAndSupplies(): ?int
    {
        return $this->averageCostForBooksAndSupplies;
    }

    public function setAverageCostForBooksAndSupplies(?int $averageCostForBooksAndSupplies): self
    {
        $this->averageCostForBooksAndSupplies = $averageCostForBooksAndSupplies;

        return $this;
    }

    public function getTuitionFeesVaryByYearOfStudy(): ?bool
    {
        return $this->tuitionFeesVaryByYearOfStudy;
    }

    public function setTuitionFeesVaryByYearOfStudy(?bool $tuitionFeesVaryByYearOfStudy): self
    {
        $this->tuitionFeesVaryByYearOfStudy = $tuitionFeesVaryByYearOfStudy;

        return $this;
    }

    public function getBoardForCommuters(): ?int
    {
        return $this->boardForCommuters;
    }

    public function setBoardForCommuters(?int $boardForCommuters): self
    {
        $this->boardForCommuters = $boardForCommuters;

        return $this;
    }

    public function getTransportationForCommuters(): ?int
    {
        return $this->transportationForCommuters;
    }

    public function setTransportationForCommuters(?int $transportationForCommuters): self
    {
        $this->transportationForCommuters = $transportationForCommuters;

        return $this;
    }

    public function getOnCampusRoomAndBoard(): ?int
    {
        return $this->onCampusRoomAndBoard;
    }

    public function setOnCampusRoomAndBoard(?int $onCampusRoomAndBoard): self
    {
        $this->onCampusRoomAndBoard = $onCampusRoomAndBoard;

        return $this;
    }

    public function getFinancialAidMethodology(): ?string
    {
        return $this->financialAidMethodology;
    }

    public function setFinancialAidMethodology(?string $financialAidMethodology): self
    {
        $this->financialAidMethodology = $financialAidMethodology;

        return $this;
    }

    public function getScholarshipsAndGrantsNeedBased(): ?string
    {
        return $this->scholarshipsAndGrantsNeedBased;
    }

    public function setScholarshipsAndGrantsNeedBased(?string $scholarshipsAndGrantsNeedBased): self
    {
        $this->scholarshipsAndGrantsNeedBased = $scholarshipsAndGrantsNeedBased;

        return $this;
    }

    public function getScholarshipsAndGrantsNonNeedBased(): ?string
    {
        return $this->scholarshipsAndGrantsNonNeedBased;
    }

    public function setScholarshipsAndGrantsNonNeedBased(?string $scholarshipsAndGrantsNonNeedBased): self
    {
        $this->scholarshipsAndGrantsNonNeedBased = $scholarshipsAndGrantsNonNeedBased;

        return $this;
    }

    public function getFederalDirectStudentLoanPrograms(): ?string
    {
        return $this->federalDirectStudentLoanPrograms;
    }

    public function setFederalDirectStudentLoanPrograms(?string $federalDirectStudentLoanPrograms): self
    {
        $this->federalDirectStudentLoanPrograms = $federalDirectStudentLoanPrograms;

        return $this;
    }

    public function getFederalFamilyEducationLoanPrograms(): ?string
    {
        return $this->federalFamilyEducationLoanPrograms;
    }

    public function setFederalFamilyEducationLoanPrograms(?string $federalFamilyEducationLoanPrograms): self
    {
        $this->federalFamilyEducationLoanPrograms = $federalFamilyEducationLoanPrograms;

        return $this;
    }

    public function getIsInstitutionalEmploymentAvailable(): ?bool
    {
        return $this->isInstitutionalEmploymentAvailable;
    }

    public function setIsInstitutionalEmploymentAvailable(?bool $isInstitutionalEmploymentAvailable): self
    {
        $this->isInstitutionalEmploymentAvailable = $isInstitutionalEmploymentAvailable;

        return $this;
    }

    public function getDirectLender(): ?bool
    {
        return $this->directLender;
    }

    public function setDirectLender(?bool $directLender): self
    {
        $this->directLender = $directLender;

        return $this;
    }
}
