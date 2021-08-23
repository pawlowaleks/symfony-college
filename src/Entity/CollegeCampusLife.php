<?php

namespace App\Entity;

use App\Repository\CollegeCampusLifeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollegeCampusLifeRepository::class)
 */
class CollegeCampusLife
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=College::class, inversedBy="collegeCampusLife", cascade={"persist", "remove"})
     */
    private $college;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $overview;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $undergradsLivingOnCampus;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $helpFindingOffCampusHousing;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qualityOfLifeRating;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $firstYearStudentsLivingOnCampus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $campusEnvironment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fireSafetyRating;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $housingOptions;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $collegeEntranceTestsRequired;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $interviewRequired;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $specialNeedServicesOffered;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $registeredStudentOrganizations;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfHonorSocieties;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfSocialSororities;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfReligiousOrganizations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $athleticDivision;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $menSports;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $womenSports;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $studentServices;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sustainability;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $greenRating;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $campusSecurityReport;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $campusWideInternetNetwork;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $percentOfClassroomsWithWirelessInternet;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $feeForNetworkUse;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $partnershipsWithTechnologyCompanies;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $personalComputerIncludedInTuitionForEachStudent;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $discountsAvailableWithHardwareVendors;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hardwareVendorsDescription;

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

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(?string $overview): self
    {
        $this->overview = $overview;

        return $this;
    }

    public function getUndergradsLivingOnCampus(): ?int
    {
        return $this->undergradsLivingOnCampus;
    }

    public function setUndergradsLivingOnCampus(?int $undergradsLivingOnCampus): self
    {
        $this->undergradsLivingOnCampus = $undergradsLivingOnCampus;

        return $this;
    }

    public function getHelpFindingOffCampusHousing(): ?bool
    {
        return $this->helpFindingOffCampusHousing;
    }

    public function setHelpFindingOffCampusHousing(?bool $helpFindingOffCampusHousing): self
    {
        $this->helpFindingOffCampusHousing = $helpFindingOffCampusHousing;

        return $this;
    }

    public function getQualityOfLifeRating(): ?int
    {
        return $this->qualityOfLifeRating;
    }

    public function setQualityOfLifeRating(?int $qualityOfLifeRating): self
    {
        $this->qualityOfLifeRating = $qualityOfLifeRating;

        return $this;
    }

    public function getFirstYearStudentsLivingOnCampus(): ?int
    {
        return $this->firstYearStudentsLivingOnCampus;
    }

    public function setFirstYearStudentsLivingOnCampus(?int $firstYearStudentsLivingOnCampus): self
    {
        $this->firstYearStudentsLivingOnCampus = $firstYearStudentsLivingOnCampus;

        return $this;
    }

    public function getCampusEnvironment(): ?string
    {
        return $this->campusEnvironment;
    }

    public function setCampusEnvironment(?string $campusEnvironment): self
    {
        $this->campusEnvironment = $campusEnvironment;

        return $this;
    }

    public function getFireSafetyRating(): ?int
    {
        return $this->fireSafetyRating;
    }

    public function setFireSafetyRating(?int $fireSafetyRating): self
    {
        $this->fireSafetyRating = $fireSafetyRating;

        return $this;
    }

    public function getHousingOptions(): ?string
    {
        return $this->housingOptions;
    }

    public function setHousingOptions(?string $housingOptions): self
    {
        $this->housingOptions = $housingOptions;

        return $this;
    }

    public function getCollegeEntranceTestsRequired(): ?bool
    {
        return $this->collegeEntranceTestsRequired;
    }

    public function setCollegeEntranceTestsRequired(?bool $collegeEntranceTestsRequired): self
    {
        $this->collegeEntranceTestsRequired = $collegeEntranceTestsRequired;

        return $this;
    }

    public function getInterviewRequired(): ?bool
    {
        return $this->interviewRequired;
    }

    public function setInterviewRequired(?bool $interviewRequired): self
    {
        $this->interviewRequired = $interviewRequired;

        return $this;
    }

    public function getSpecialNeedServicesOffered(): ?string
    {
        return $this->specialNeedServicesOffered;
    }

    public function setSpecialNeedServicesOffered(?string $specialNeedServicesOffered): self
    {
        $this->specialNeedServicesOffered = $specialNeedServicesOffered;

        return $this;
    }

    public function getRegisteredStudentOrganizations(): ?int
    {
        return $this->registeredStudentOrganizations;
    }

    public function setRegisteredStudentOrganizations(?int $registeredStudentOrganizations): self
    {
        $this->registeredStudentOrganizations = $registeredStudentOrganizations;

        return $this;
    }

    public function getNumberOfHonorSocieties(): ?int
    {
        return $this->numberOfHonorSocieties;
    }

    public function setNumberOfHonorSocieties(?int $numberOfHonorSocieties): self
    {
        $this->numberOfHonorSocieties = $numberOfHonorSocieties;

        return $this;
    }

    public function getNumberOfSocialSororities(): ?int
    {
        return $this->numberOfSocialSororities;
    }

    public function setNumberOfSocialSororities(?int $numberOfSocialSororities): self
    {
        $this->numberOfSocialSororities = $numberOfSocialSororities;

        return $this;
    }

    public function getNumberOfReligiousOrganizations(): ?int
    {
        return $this->numberOfReligiousOrganizations;
    }

    public function setNumberOfReligiousOrganizations(?int $numberOfReligiousOrganizations): self
    {
        $this->numberOfReligiousOrganizations = $numberOfReligiousOrganizations;

        return $this;
    }

    public function getAthleticDivision(): ?string
    {
        return $this->athleticDivision;
    }

    public function setAthleticDivision(?string $athleticDivision): self
    {
        $this->athleticDivision = $athleticDivision;

        return $this;
    }

    public function getMenSports(): ?string
    {
        return $this->menSports;
    }

    public function setMenSports(?string $menSports): self
    {
        $this->menSports = $menSports;

        return $this;
    }

    public function getWomenSports(): ?string
    {
        return $this->womenSports;
    }

    public function setWomenSports(?string $womenSports): self
    {
        $this->womenSports = $womenSports;

        return $this;
    }

    public function getStudentServices(): ?string
    {
        return $this->studentServices;
    }

    public function setStudentServices(?string $studentServices): self
    {
        $this->studentServices = $studentServices;

        return $this;
    }

    public function getSustainability(): ?string
    {
        return $this->sustainability;
    }

    public function setSustainability(?string $sustainability): self
    {
        $this->sustainability = $sustainability;

        return $this;
    }

    public function getGreenRating(): ?int
    {
        return $this->greenRating;
    }

    public function setGreenRating(?int $greenRating): self
    {
        $this->greenRating = $greenRating;

        return $this;
    }

    public function getCampusSecurityReport(): ?string
    {
        return $this->campusSecurityReport;
    }

    public function setCampusSecurityReport(?string $campusSecurityReport): self
    {
        $this->campusSecurityReport = $campusSecurityReport;

        return $this;
    }

    public function getCampusWideInternetNetwork(): ?bool
    {
        return $this->campusWideInternetNetwork;
    }

    public function setCampusWideInternetNetwork(?bool $campusWideInternetNetwork): self
    {
        $this->campusWideInternetNetwork = $campusWideInternetNetwork;

        return $this;
    }

    public function getPercentOfClassroomsWithWirelessInternet(): ?int
    {
        return $this->percentOfClassroomsWithWirelessInternet;
    }

    public function setPercentOfClassroomsWithWirelessInternet(?int $percentOfClassroomsWithWirelessInternet): self
    {
        $this->percentOfClassroomsWithWirelessInternet = $percentOfClassroomsWithWirelessInternet;

        return $this;
    }

    public function getFeeForNetworkUse(): ?bool
    {
        return $this->feeForNetworkUse;
    }

    public function setFeeForNetworkUse(?bool $feeForNetworkUse): self
    {
        $this->feeForNetworkUse = $feeForNetworkUse;

        return $this;
    }

    public function getPartnershipsWithTechnologyCompanies(): ?bool
    {
        return $this->partnershipsWithTechnologyCompanies;
    }

    public function setPartnershipsWithTechnologyCompanies(?bool $partnershipsWithTechnologyCompanies): self
    {
        $this->partnershipsWithTechnologyCompanies = $partnershipsWithTechnologyCompanies;

        return $this;
    }

    public function getPersonalComputerIncludedInTuitionForEachStudent(): ?bool
    {
        return $this->personalComputerIncludedInTuitionForEachStudent;
    }

    public function setPersonalComputerIncludedInTuitionForEachStudent(?bool $personalComputerIncludedInTuitionForEachStudent): self
    {
        $this->personalComputerIncludedInTuitionForEachStudent = $personalComputerIncludedInTuitionForEachStudent;

        return $this;
    }

    public function getDiscountsAvailableWithHardwareVendors(): ?bool
    {
        return $this->discountsAvailableWithHardwareVendors;
    }

    public function setDiscountsAvailableWithHardwareVendors(?bool $discountsAvailableWithHardwareVendors): self
    {
        $this->discountsAvailableWithHardwareVendors = $discountsAvailableWithHardwareVendors;

        return $this;
    }

    public function getHardwareVendorsDescription(): ?string
    {
        return $this->hardwareVendorsDescription;
    }

    public function setHardwareVendorsDescription(?string $hardwareVendorsDescription): self
    {
        $this->hardwareVendorsDescription = $hardwareVendorsDescription;

        return $this;
    }
}
