<?php

namespace App\Engine\Entity;

class CollegeCampusLifeItem extends AbstractEntity
{

    // Overview
    private ?string $overview;

    // Campus Life
    private ?int $undergradsLivingOnCampus;
    private ?bool $helpFindingOffCampusHousing;
    private ?int $qualityOfLifeRating;
    private ?int $firstYearStudentsLivingOnCampus;
    private ?string $campusEnvironment;
    private ?int $fireSafetyRating;

    // Housing Options
    private ?string $housingOptions;

    // Special Needs Admissions
    private ?bool $collegeEntranceTestsRequired;
    private ?bool $interviewRequired;

    // Special Need Services Offered
    private ?string $specialNeedServicesOffered;

    // Student Activities
    private ?int $registeredStudentOrganizations;
    private ?int $numberOfHonorSocieties;
    private ?int $numberOfSocialSororities;
    private ?int $numberOfReligiousOrganizations;

    // Sports
    private ?string $athleticDivision;
    private ?string $menSports;
    private ?string $womenSports;

    // Student Services
    private ?string $studentServices;

    // Sustainability;
    private ?string $sustainability;
    private ?int $greenRating;

    // Campus Security Report
    private ?string $campusSecurityReport;

    // Other Information;
    private ?bool $campusWideInternetNetwork;
    private ?int $percentOfClassroomsWithWirelessInternet;
    private ?bool $feeForNetworkUse;
    private ?bool $partnershipsWithTechnologyCompanies;
    private ?bool $personalComputerIncludedInTuitionForEachStudent;
    private ?bool $discountsAvailableWithHardwareVendors;
    private ?string $hardwareVendorsDescription;

    /**
     * @return string|null
     */
    public function getOverview(): ?string
    {
        return $this->overview ?? null;
    }

    /**
     * @param string|null $overview
     */
    public function setOverview(?string $overview): void
    {
        $this->overview = $overview;
    }

    /**
     * @return int|null
     */
    public function getUndergradsLivingOnCampus(): ?int
    {
        return $this->undergradsLivingOnCampus ?? null;
    }

    /**
     * @param int|null $undergradsLivingOnCampus
     */
    public function setUndergradsLivingOnCampus(?int $undergradsLivingOnCampus): void
    {
        $this->undergradsLivingOnCampus = $undergradsLivingOnCampus;
    }

    /**
     * @return bool|null
     */
    public function getHelpFindingOffCampusHousing(): ?bool
    {
        return $this->helpFindingOffCampusHousing ?? null;
    }

    /**
     * @param bool|null $helpFindingOffCampusHousing
     */
    public function setHelpFindingOffCampusHousing(?bool $helpFindingOffCampusHousing): void
    {
        $this->helpFindingOffCampusHousing = $helpFindingOffCampusHousing;
    }

    /**
     * @return int|null
     */
    public function getQualityOfLifeRating(): ?int
    {
        return $this->qualityOfLifeRating ?? null;
    }

    /**
     * @param int|null $qualityOfLifeRating
     */
    public function setQualityOfLifeRating(?int $qualityOfLifeRating): void
    {
        $this->qualityOfLifeRating = $qualityOfLifeRating;
    }

    /**
     * @return int|null
     */
    public function getFirstYearStudentsLivingOnCampus(): ?int
    {
        return $this->firstYearStudentsLivingOnCampus ?? null;
    }

    /**
     * @param int|null $firstYearStudentsLivingOnCampus
     */
    public function setFirstYearStudentsLivingOnCampus(?int $firstYearStudentsLivingOnCampus): void
    {
        $this->firstYearStudentsLivingOnCampus = $firstYearStudentsLivingOnCampus;
    }

    /**
     * @return string|null
     */
    public function getCampusEnvironment(): ?string
    {
        return $this->campusEnvironment ?? null;
    }

    /**
     * @param string|null $campusEnvironment
     */
    public function setCampusEnvironment(?string $campusEnvironment): void
    {
        $this->campusEnvironment = $campusEnvironment;
    }

    /**
     * @return int|null
     */
    public function getFireSafetyRating(): ?int
    {
        return $this->fireSafetyRating ?? null;
    }

    /**
     * @param int|null $fireSafetyRating
     */
    public function setFireSafetyRating(?int $fireSafetyRating): void
    {
        $this->fireSafetyRating = $fireSafetyRating;
    }

    /**
     * @return string|null
     */
    public function getHousingOptions(): ?string
    {
        return $this->housingOptions ?? null;
    }

    /**
     * @param string|null $housingOptions
     */
    public function setHousingOptions(?string $housingOptions): void
    {
        $this->housingOptions = $housingOptions;
    }

    /**
     * @return bool|null
     */
    public function getCollegeEntranceTestsRequired(): ?bool
    {
        return $this->collegeEntranceTestsRequired ?? null;
    }

    /**
     * @param bool|null $collegeEntranceTestsRequired
     */
    public function setCollegeEntranceTestsRequired(?bool $collegeEntranceTestsRequired): void
    {
        $this->collegeEntranceTestsRequired = $collegeEntranceTestsRequired;
    }

    /**
     * @return bool|null
     */
    public function getInterviewRequired(): ?bool
    {
        return $this->interviewRequired ?? null;
    }

    /**
     * @param bool|null $interviewRequired
     */
    public function setInterviewRequired(?bool $interviewRequired): void
    {
        $this->interviewRequired = $interviewRequired;
    }

    /**
     * @return string|null
     */
    public function getSpecialNeedServicesOffered(): ?string
    {
        return $this->specialNeedServicesOffered ?? null;
    }

    /**
     * @param string|null $specialNeedServicesOffered
     */
    public function setSpecialNeedServicesOffered(?string $specialNeedServicesOffered): void
    {
        $this->specialNeedServicesOffered = $specialNeedServicesOffered;
    }

    /**
     * @return int|null
     */
    public function getRegisteredStudentOrganizations(): ?int
    {
        return $this->registeredStudentOrganizations ?? null;
    }

    /**
     * @param int|null $registeredStudentOrganizations
     */
    public function setRegisteredStudentOrganizations(?int $registeredStudentOrganizations): void
    {
        $this->registeredStudentOrganizations = $registeredStudentOrganizations;
    }

    /**
     * @return int|null
     */
    public function getNumberOfHonorSocieties(): ?int
    {
        return $this->numberOfHonorSocieties ?? null;
    }

    /**
     * @param int|null $numberOfHonorSocieties
     */
    public function setNumberOfHonorSocieties(?int $numberOfHonorSocieties): void
    {
        $this->numberOfHonorSocieties = $numberOfHonorSocieties;
    }

    /**
     * @return int|null
     */
    public function getNumberOfSocialSororities(): ?int
    {
        return $this->numberOfSocialSororities ?? null;
    }

    /**
     * @param int|null $numberOfSocialSororities
     */
    public function setNumberOfSocialSororities(?int $numberOfSocialSororities): void
    {
        $this->numberOfSocialSororities = $numberOfSocialSororities;
    }

    /**
     * @return int|null
     */
    public function getNumberOfReligiousOrganizations(): ?int
    {
        return $this->numberOfReligiousOrganizations ?? null;
    }

    /**
     * @param int|null $numberOfReligiousOrganizations
     */
    public function setNumberOfReligiousOrganizations(?int $numberOfReligiousOrganizations): void
    {
        $this->numberOfReligiousOrganizations = $numberOfReligiousOrganizations;
    }

    /**
     * @return string|null
     */
    public function getAthleticDivision(): ?string
    {
        return $this->athleticDivision ?? null;
    }

    /**
     * @param string|null $athleticDivision
     */
    public function setAthleticDivision(?string $athleticDivision): void
    {
        $this->athleticDivision = $athleticDivision;
    }

    /**
     * @return string|null
     */
    public function getMenSports(): ?string
    {
        return $this->menSports ?? null;
    }

    /**
     * @param string|null $menSports
     */
    public function setMenSports(?string $menSports): void
    {
        $this->menSports = $menSports;
    }

    /**
     * @return string|null
     */
    public function getWomenSports(): ?string
    {
        return $this->womenSports ?? null;
    }

    /**
     * @param string|null $womenSports
     */
    public function setWomenSports(?string $womenSports): void
    {
        $this->womenSports = $womenSports;
    }

    /**
     * @return string|null
     */
    public function getStudentServices(): ?string
    {
        return $this->studentServices ?? null;
    }

    /**
     * @param string|null $studentServices
     */
    public function setStudentServices(?string $studentServices): void
    {
        $this->studentServices = $studentServices;
    }

    /**
     * @return string|null
     */
    public function getSustainability(): ?string
    {
        return $this->sustainability ?? null;
    }

    /**
     * @param string|null $sustainability
     */
    public function setSustainability(?string $sustainability): void
    {
        $this->sustainability = $sustainability;
    }

    /**
     * @return int|null
     */
    public function getGreenRating(): ?int
    {
        return $this->greenRating ?? null;
    }

    /**
     * @param int|null $greenRating
     */
    public function setGreenRating(?int $greenRating): void
    {
        $this->greenRating = $greenRating;
    }

    /**
     * @return string|null
     */
    public function getCampusSecurityReport(): ?string
    {
        return $this->campusSecurityReport ?? null;
    }

    /**
     * @param string|null $campusSecurityReport
     */
    public function setCampusSecurityReport(?string $campusSecurityReport): void
    {
        $this->campusSecurityReport = $campusSecurityReport;
    }

    /**
     * @return bool|null
     */
    public function getCampusWideInternetNetwork(): ?bool
    {
        return $this->campusWideInternetNetwork ?? null;
    }

    /**
     * @param bool|null $campusWideInternetNetwork
     */
    public function setCampusWideInternetNetwork(?bool $campusWideInternetNetwork): void
    {
        $this->campusWideInternetNetwork = $campusWideInternetNetwork;
    }

    /**
     * @return int|null
     */
    public function getPercentOfClassroomsWithWirelessInternet(): ?int
    {
        return $this->percentOfClassroomsWithWirelessInternet ?? null;
    }

    /**
     * @param int|null $percentOfClassroomsWithWirelessInternet
     */
    public function setPercentOfClassroomsWithWirelessInternet(?int $percentOfClassroomsWithWirelessInternet): void
    {
        $this->percentOfClassroomsWithWirelessInternet = $percentOfClassroomsWithWirelessInternet;
    }

    /**
     * @return bool|null
     */
    public function getFeeForNetworkUse(): ?bool
    {
        return $this->feeForNetworkUse ?? null;
    }

    /**
     * @param bool|null $feeForNetworkUse
     */
    public function setFeeForNetworkUse(?bool $feeForNetworkUse): void
    {
        $this->feeForNetworkUse = $feeForNetworkUse;
    }

    /**
     * @return bool|null
     */
    public function getPartnershipsWithTechnologyCompanies(): ?bool
    {
        return $this->partnershipsWithTechnologyCompanies ?? null;
    }

    /**
     * @param bool|null $partnershipsWithTechnologyCompanies
     */
    public function setPartnershipsWithTechnologyCompanies(?bool $partnershipsWithTechnologyCompanies): void
    {
        $this->partnershipsWithTechnologyCompanies = $partnershipsWithTechnologyCompanies;
    }

    /**
     * @return bool|null
     */
    public function getPersonalComputerIncludedInTuitionForEachStudent(): ?bool
    {
        return $this->personalComputerIncludedInTuitionForEachStudent ?? null;
    }

    /**
     * @param bool|null $personalComputerIncludedInTuitionForEachStudent
     */
    public function setPersonalComputerIncludedInTuitionForEachStudent(?bool $personalComputerIncludedInTuitionForEachStudent): void
    {
        $this->personalComputerIncludedInTuitionForEachStudent = $personalComputerIncludedInTuitionForEachStudent;
    }

    /**
     * @return bool|null
     */
    public function getDiscountsAvailableWithHardwareVendors(): ?bool
    {
        return $this->discountsAvailableWithHardwareVendors ?? null;
    }

    /**
     * @param bool|null $discountsAvailableWithHardwareVendors
     */
    public function setDiscountsAvailableWithHardwareVendors(?bool $discountsAvailableWithHardwareVendors): void
    {
        $this->discountsAvailableWithHardwareVendors = $discountsAvailableWithHardwareVendors;
    }

    /**
     * @return string|null
     */
    public function getHardwareVendorsDescription(): ?string
    {
        return $this->hardwareVendorsDescription ?? null;
    }

    /**
     * @param string|null $hardwareVendorsDescription
     */
    public function setHardwareVendorsDescription(?string $hardwareVendorsDescription): void
    {
        $this->hardwareVendorsDescription = $hardwareVendorsDescription;
    }


}