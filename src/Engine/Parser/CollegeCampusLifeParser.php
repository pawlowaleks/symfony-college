<?php

namespace App\Engine\Parser;

use App\Engine\Entity\CollegeCampusLifeItem;
use Symfony\Component\DomCrawler\Crawler;

class CollegeCampusLifeParser extends AbstractParser
{

    private Crawler $crawler;

    private CollegeCampusLifeItem $item;

    /**
     * @inheritDoc
     */
    public function parse(string $url, string $content): ?CollegeCampusLifeItem
    {
        $this->crawler = new Crawler($content, $url);
        $this->item = new CollegeCampusLifeItem();

        $campusLifeTabDom = $this->crawler->filter('#campuslife > div.tab-content-wrapper');
        if (!$campusLifeTabDom->count()) {
            return null;
        }

        $this->parseOverview();
        $this->parseCampusLife();
        $this->parseHousingOptions();
        $this->parseSpecialNeedsAdmissions();
        $this->parseSpecialNeedServicesOffered();
        $this->parseStudentActivities();
        $this->parseSports();
        $this->parseStudentServices();
        $this->parseSustainability();
        $this->parseCampusSecurityReport();
        $this->parseOtherInformation();

        return $this->item;
    }

    private function parseOverview(): bool
    {
        $overviewDom = $this->crawler->filter('#cam-ovrw > div.col-sm-9');
        if (!$overviewDom->count()) {
            return false;
        }
        $this->item->setOverview($overviewDom->text());
        return true;
    }

    private function parseCampusLife(): bool
    {
        $campusLifeDom = $this->crawler->filter('#cam-lf > div.col-sm-9');
        if (!$campusLifeDom->count()) {
            return false;
        }
        $undergradsLivingOnCampus = $campusLifeDom->filter('div:nth-child(1) > div:nth-child(1) > div.number-callout');
        if ($undergradsLivingOnCampus->count()) {
            $this->item->setUndergradsLivingOnCampus((int)$undergradsLivingOnCampus->text());
        }
        $helpFindingOffCampusHousing = $campusLifeDom->filter('div:nth-child(1) > div:nth-child(2) > div.number-callout');
        if ($helpFindingOffCampusHousing->count()) {
            $this->item->setHelpFindingOffCampusHousing($helpFindingOffCampusHousing->text() == 'Yes');
        }
        $qualityOfLifeRating = $campusLifeDom->filter('div:nth-child(3) > div:nth-child(1) > div.number-callout');
        if ($qualityOfLifeRating->count()) {
            $this->item->setQualityOfLifeRating((int)$qualityOfLifeRating->text());
        }
        $firstYearStudentsLivingOnCampus = $campusLifeDom->filter('div:nth-child(3) > div:nth-child(2) > div.number-callout');
        if ($firstYearStudentsLivingOnCampus->count()) {
            $this->item->setFirstYearStudentsLivingOnCampus((int)$firstYearStudentsLivingOnCampus->text());
        }
        $campusEnvironment = $campusLifeDom->filter('div:nth-child(5) > div:nth-child(1) > div.number-callout');
        if ($campusLifeDom->count()) {
            $this->item->setCampusEnvironment($campusEnvironment->text());
        }
        $fireSafetyRating = $campusLifeDom->filter('div:nth-child(5) > div:nth-child(2) > div.number-callout > span');
        if ($fireSafetyRating->count()) {
            $this->item->setFireSafetyRating((int)$fireSafetyRating->text());
        }
        return true;
    }

    private function parseHousingOptions(): bool
    {
        $housingOptions = $this->crawler->filter('#cam-opt > div.col-sm-9 > div');
        if (!$housingOptions->count()) {
            return false;
        }
        $this->item->setHousingOptions(self::trimText($housingOptions->text(null, false)));
        return true;
    }

    private function parseSpecialNeedsAdmissions(): bool
    {
        $specialNeedsAdmissions = $this->crawler->filter('#cam-adm > div.col-sm-9');
        if (!$specialNeedsAdmissions->count()) {
            return false;
        }
        $collegeEntranceTestsRequired = $specialNeedsAdmissions->filter('div:nth-child(2) > div.col-xs-5.col-sm-5.text-right > div');
        if ($collegeEntranceTestsRequired->count()) {
            $this->item->setCollegeEntranceTestsRequired($collegeEntranceTestsRequired->text() == 'Yes');
        }
        $interviewRequired = $specialNeedsAdmissions->filter('div:nth-child(4) > div.col-xs-5.col-sm-5.text-right > div');
        if ($interviewRequired->count()) {
            $this->item->setInterviewRequired($interviewRequired->text() == 'Yes');
        }
        return true;
    }

    private function parseSpecialNeedServicesOffered(): bool
    {
        $specialNeedServicesOffered = $this->crawler->filter('#cam-srvo > div.col-sm-9');
        if ($specialNeedServicesOffered->count()) {
            $this->item->setSpecialNeedServicesOffered(self::trimText($specialNeedServicesOffered->text(null, false)));
        }
        return true;
    }

    private function parseStudentActivities(): bool
    {
        $studentActivities = $this->crawler->filter('#cam-act > div.col-sm-9');
        if (!$studentActivities->count()) {
            return false;
        }
        $registeredStudentOrganizations = $studentActivities->filter('div:nth-child(1) > div:nth-child(1) > div.number-callout');
        if ($registeredStudentOrganizations->count()) {
            $this->item->setRegisteredStudentOrganizations((int)$registeredStudentOrganizations->text());
        }
        $numberOfHonorSocieties = $studentActivities->filter('div:nth-child(1) > div:nth-child(2) > div.number-callout');
        if ($numberOfHonorSocieties->count()) {
            $this->item->setNumberOfHonorSocieties((int)$numberOfHonorSocieties->text());
        }
        $numberOfSocialSororities = $studentActivities->filter('div:nth-child(3) > div:nth-child(1) > div.number-callout');
        if ($numberOfSocialSororities->count()) {
            $this->item->setNumberOfSocialSororities((int)$numberOfSocialSororities->text());
        }
        $numberOfReligiousOrganizations = $studentActivities->filter('div:nth-child(3) > div:nth-child(2) > div.number-callout');
        if ($numberOfReligiousOrganizations->count()) {
            $this->item->setNumberOfReligiousOrganizations((int)$numberOfReligiousOrganizations->text());
        }
        return true;
    }

    private function parseSports(): bool
    {
        $sports = $this->crawler->filter('#cam-spr > div.col-sm-9');
        if (!$sports->count()) {
            return false;
        }
        $athleticDivision = $sports->filter('div:nth-child(1) > div.col-xs-5.col-sm-5.text-right > div');
        if ($athleticDivision->count()) {
            $this->item->setAthleticDivision($athleticDivision->text());
        }
        $menSports = $sports->filter('div:nth-child(3) > div:nth-child(1) > div:nth-child(4)');
        if ($menSports->count()) {
            $this->item->setMenSports(self::trimText($menSports->text(null, false)));
        }
        $womenSports = $sports->filter('div:nth-child(3) > div:nth-child(2) > div:nth-child(4)');
        if ($womenSports->count()) {
            $this->item->setWomenSports(self::trimText($womenSports->text(null, false)));
        }
        return true;
    }

    private function parseStudentServices(): bool
    {
        $studentServices = $this->crawler->filter('#cam-srv > div.col-sm-9');
        if (!$studentServices->count()) {
            return false;
        }
        $this->item->setStudentServices(self::trimText($studentServices->text(null, false)));
        return true;
    }

    private function parseSustainability(): bool
    {
        $sustainability = $this->crawler->filter('#cam-sst > div.col-sm-9 > div.blurb');
        if ($sustainability->count()) {
            $this->item->setSustainability($sustainability->text());
        }
        $greenRating = $this->crawler->filter('#cam-sst > div.col-sm-9 > div.row > div > div.number-callout > span');
        if ($greenRating->count()) {
            $this->item->setGreenRating((int)$greenRating->text());
        }
        return true;
    }

    private function parseCampusSecurityReport(): bool
    {
        $campusSecurityReport = $this->crawler->filter('#cam-rpt > div.col-sm-9');
        if (!$campusSecurityReport->count()) {
            return false;
        }
        $this->item->setCampusSecurityReport(self::trimText($campusSecurityReport->text(null, false)));
        return true;
    }

    private function parseOtherInformation(): bool
    {
        $otherInformation = $this->crawler->filter('#cam-inf > div.col-sm-9 > div');
        if (!$otherInformation->count()) {
            return false;
        }
        $campusWideInternetNetwork = $otherInformation->filter('div:nth-child(1) > div.col-xs-5.col-sm-5.text-right > div');
        if ($campusWideInternetNetwork->count()) {
            $this->item->setCampusWideInternetNetwork($campusWideInternetNetwork->text() == 'Yes');
        }
        $percentOfClassroomsWithWirelessInternet = $otherInformation->filter('div:nth-child(3) > div.col-xs-5.col-sm-5.text-right > div');
        if ($percentOfClassroomsWithWirelessInternet->count()) {
            $this->item->setPercentOfClassroomsWithWirelessInternet((int)$percentOfClassroomsWithWirelessInternet);
        }
        $feeForNetworkUse = $otherInformation->filter('div:nth-child(5) > div.col-xs-5.col-sm-5.text-right > div');
        if ($feeForNetworkUse->count()) {
            $this->item->setFeeForNetworkUse($feeForNetworkUse->text() == 'Yes');
        }
        $partnershipsWithTechnologyCompanies = $otherInformation->filter('div:nth-child(7) > div.col-xs-5.col-sm-5.text-right > div');
        if ($partnershipsWithTechnologyCompanies->count()) {
            $this->item->setPartnershipsWithTechnologyCompanies($partnershipsWithTechnologyCompanies->text() == 'Yes');
        }
        $personalComputerIncluded = $otherInformation->filter('div:nth-child(9) > div.col-xs-5.col-sm-5.text-right > div');
        if ($personalComputerIncluded->count()) {
            $this->item->setPersonalComputerIncludedInTuitionForEachStudent($personalComputerIncluded->text() == 'Yes');
        }
        $discountsAvailable = $otherInformation->filter('div:nth-child(11) > div.col-xs-5.col-sm-5.text-right > div');
        if ($discountsAvailable->count()) {
            $this->item->setDiscountsAvailableWithHardwareVendors($discountsAvailable->text() == 'Yes');
        }
        $hardwareVendorsDescription = $otherInformation->filter('div:nth-child(13) > div.col-xs-5.col-sm-5.text-right > div');
        if ($hardwareVendorsDescription->count()) {
            $this->item->setHardwareVendorsDescription($hardwareVendorsDescription->text());
        }
        return true;
    }

}