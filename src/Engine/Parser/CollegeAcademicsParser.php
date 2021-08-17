<?php

namespace App\Engine\Parser;

use App\Engine\Entity\CollegeAcademicsItem;
use Symfony\Component\DomCrawler\Crawler;

class CollegeAcademicsParser extends AbstractParser
{

    /**
     * @param string $url
     * @param string $content
     * @return CollegeAcademicsItem|null
     */
    public function parse(string $url, string $content): ?CollegeAcademicsItem
    {
        $crawler = new Crawler($content, $url);

        $collegeAcademicsItem = new CollegeAcademicsItem();

        $majorsDom = $crawler->filter('#acd-mjr > div.col-sm-9 > div');
        if ($majorsDom->count()) {
            $collegeAcademicsItem->setMajors(self::trimText($majorsDom->text(null, false)));
        }

        $degreesDom = $crawler->filter('#acd-dgr > div.col-sm-9 > div');
        if ($degreesDom->count()) {
            $collegeAcademicsItem->setDegrees(self::trimText($degreesDom->text(null, false)));
        }

        $prominentAlumniDom = $crawler->filter('#acd-alm > div.col-sm-9');
        if ($prominentAlumniDom->count()) {
            $collegeAcademicsItem->setProminentAlumni(self::trimText($prominentAlumniDom->text(null, false)));
        }

        return $collegeAcademicsItem;
    }
}