<?php

namespace App\Engine\Parser;

use App\Engine\Entity\AbstractEntity;
use App\Engine\Entity\CollegeCareersItem;
use NumberFormatter;
use Symfony\Component\DomCrawler\Crawler;

class CollegeCareersParser extends AbstractParser
{

    /**
     * @param string $url
     * @param string $content
     * @return AbstractEntity|null
     */
    public function parse(string $url, string $content): ?CollegeCareersItem
    {
        $crawler = new Crawler($content, $url);
        $numberFormatter = new NumberFormatter('en_US', NumberFormatter::DECIMAL);


        $collegeCareersItem = new CollegeCareersItem();

        $graduateIn4YearsDom = $crawler->filter('#car-rts > div.col-sm-9 > div > div:nth-child(1) > div.number-callout');
        if ($graduateIn4YearsDom->count()) {
            $collegeCareersItem->setGraduateIn4Years((int)$graduateIn4YearsDom->text());
        }
        $graduateIn5YearsDom = $crawler->filter('#car-rts > div.col-sm-9 > div > div:nth-child(2) > div.number-callout');
        if ($graduateIn5YearsDom->count()) {
            $collegeCareersItem->setGraduateIn5Years((int)$graduateIn5YearsDom->text());
        }
        $graduateIn6YearsDom = $crawler->filter('#car-rts > div.col-sm-9 > div > div:nth-child(3) > div.number-callout');
        if ($graduateIn6YearsDom->count()) {
            $collegeCareersItem->setGraduateIn6Years((int)$graduateIn6YearsDom->text());
        }

        $interviewsAvailableDom = $crawler->filter('#car-srv > div.col-sm-9 > div:nth-child(1) > div.col-xs-5.col-sm-5.text-right > div');
        if ($interviewsAvailableDom->count()) {
            $interviewsAvailable = $interviewsAvailableDom->text() == 'Yes';
            $collegeCareersItem->setOnCampusJobInterviewsAvailable($interviewsAvailable);
        }

        $careerServicesDom = $crawler->filter('#car-srv > div.col-sm-9 > div:nth-child(3)');
        if ($careerServicesDom->count()) {
            $collegeCareersItem->setCareerServices($careerServicesDom->text());
        }

        $startingMedianSalary1Dom = $crawler->filter('#car-tcm > div.col-sm-9 > div:nth-child(2) > div.col-xs-5.col-sm-5.text-right > div');
        if ($startingMedianSalary1Dom->count()) {
            $startingMedianSalary1 = $numberFormatter->parse(mb_substr($startingMedianSalary1Dom->text(), 1));
            $collegeCareersItem->setStartingMedianSalaryUpToBachelorsDegreeCompletedOnly($startingMedianSalary1);
        }

        $midCareerMedianSalary1Dom = $crawler->filter('#car-tcm > div.col-sm-9 > div:nth-child(4) > div.col-xs-5.col-sm-5.text-right > div');
        if ($midCareerMedianSalary1Dom->count()) {
            $midCareerMedianSalary1 = $numberFormatter->parse(mb_substr($midCareerMedianSalary1Dom->text(), 1));
            $collegeCareersItem->setMidCareerMedianSalaryUptoBachelorsDegreeCompletedOnly($midCareerMedianSalary1);
        }

        $startingMedianSalary2Dom = $crawler->filter('#car-tcm > div.col-sm-9 > div:nth-child(6) > div.col-xs-5.col-sm-5.text-right > div');
        if ($startingMedianSalary2Dom->count()) {
            $startingMedianSalary2 = $numberFormatter->parse(mb_substr($startingMedianSalary2Dom->text(), 1));
            $collegeCareersItem->setStartingMedianSalaryAtLeastBachelorsDegree($startingMedianSalary2);
        }

        $midCareerMedianSalary2Dom = $crawler->filter('#car-tcm > div.col-sm-9 > div:nth-child(8) > div.col-xs-5.col-sm-5.text-right > div');
        if ($midCareerMedianSalary2Dom->count()) {
            $midCareerMedianSalary2 = $numberFormatter->parse(mb_substr($midCareerMedianSalary2Dom->text(), 1));
            $collegeCareersItem->setMidCareerMedianSalaryAtLeastBachelorsDegree($midCareerMedianSalary2);
        }


        $percentHighJobMeaningDom = $crawler->filter('#car-tcm > div.col-sm-9 > div:nth-child(10) > div.col-xs-5.col-sm-5.text-right > div');
        if ($percentHighJobMeaningDom->count()) {
            $percentHighJobMeaning = $numberFormatter->parse($percentHighJobMeaningDom->text());
            $collegeCareersItem->setPercentHighJobMeaning($percentHighJobMeaning);
        }

        $percentSTEMDom = $crawler->filter('#car-tcm > div.col-sm-9 > div:nth-child(12) > div.col-xs-5.col-sm-5.text-right > div');
        if ($percentSTEMDom->count()) {
            $percentSTEM = $numberFormatter->parse($percentSTEMDom->text());
            $collegeCareersItem->setPercentSTEM($percentSTEM);
        }

        $roiRatingDom = $crawler->filter('#car-tcm > div.col-sm-9 > div:nth-child(14) > div > div.number-callout');
        if ($roiRatingDom->count()) {
            $collegeCareersItem->setRoiRating((int)$roiRatingDom->text());
        }

        return $collegeCareersItem;
    }
}