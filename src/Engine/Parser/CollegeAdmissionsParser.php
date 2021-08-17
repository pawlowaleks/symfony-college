<?php

namespace App\Engine\Parser;

use App\Engine\Entity\CollegeAdmissionsItem;
use NumberFormatter;
use Symfony\Component\DomCrawler\Crawler;

class CollegeAdmissionsParser extends AbstractParser
{

    /**
     * @param string $url
     * @param string $content
     * @return CollegeAdmissionsItem|null
     */
    public function parse(string $url, string $content): ?CollegeAdmissionsItem
    {
        $crawler = new Crawler($content, $url);

        $collegeAdmissionsItem = new CollegeAdmissionsItem();

        $tabContentWrapperDom = $crawler->filter('#admissions > div.tab-content-wrapper');
        if (!$tabContentWrapperDom->count()) {
            return null;
        }

        $numberFormatter = new NumberFormatter('en_US', NumberFormatter::DECIMAL);

        $overviewDom = $tabContentWrapperDom->filter('div:nth-child(2) > div');

        $applicantsDom = $overviewDom->filter('div > div:nth-child(1) > span.box-value');
        if ($applicantsDom->count()) {
            $collegeAdmissionsItem->setApplicants($numberFormatter->parse($applicantsDom->text()));
        }

        $acceptanceRateDom = $overviewDom->filter('div > div:nth-child(2) > span.box-value');
        if ($acceptanceRateDom->count()) {
            $collegeAdmissionsItem->setAcceptanceRate($numberFormatter->parse($acceptanceRateDom->text()));
        }

        $averageHsgpaDom = $overviewDom->filter('div > div:nth-child(3) > span.box-value');
        if ($averageHsgpaDom->count()) {
            $collegeAdmissionsItem->setAverageHsgpa($numberFormatter->parse($averageHsgpaDom->text()));
        }


        $gpaBreakDownDom = $crawler->filter('#adm-gpa > div.col-sm-9 > div > div.col-sm-4');
        if ($gpaBreakDownDom->count()) {
            $collegeAdmissionsItem->setGpaBreakdown(self::trimText($gpaBreakDownDom->text()));
        }

        // #adm-scr > div.col-sm-9 > div
        $testScoresDom = $crawler->filter('#adm-scr > div.col-sm-9 > div');
        if ($testScoresDom->count()) {
            $collegeAdmissionsItem->setTestScores(self::trimText($testScoresDom->text()));
        }

        $deadlinesDom = $crawler->filter('#adm-ddl > div.col-sm-9');
        if ($deadlinesDom) {
            $collegeAdmissionsItem->setDeadlines(self::trimText($deadlinesDom->text()));
        }


        return $collegeAdmissionsItem;
    }
}