<?php

namespace App\Engine\Parser;

use App\Engine\Entity\CollegeTuitionItem;
use Symfony\Component\DomCrawler\Crawler;

class CollegeTuitionParser extends AbstractParser
{

    public function parse(string $url, string $content): ?CollegeTuitionItem
    {
        $crawler = new Crawler($content, $url);

        $item = new CollegeTuitionItem();

        $datesDom = $crawler->filter('#tut-dts > div.col-sm-9 > div');
        if ($datesDom->count()) {
            $item->setDates(self::trimText($datesDom->text(null, false)));
        }

        $requiredFormsDom = $crawler->filter('#tut-frm > div.col-sm-9 > div');
        if ($requiredFormsDom->count()) {
            $item->setRequiredForms(self::trimText($requiredFormsDom->text(null, false)));
        }

        $financialAidStatisticsDom = $crawler->filter('#tut-sts > div.col-sm-9');
        if ($financialAidStatisticsDom->count()) {
            $item->setFinancialAidStatistics(self::trimText($financialAidStatisticsDom->text(null, false)));
        }

        $expensesDom = $crawler->filter('#tut-xpn > div.col-sm-9');
        if ($expensesDom->count()) {
            $item->setExpensesPerAcademicYear(self::trimText($expensesDom->text(null, false)));
        }

        $availableAidDom = $crawler->filter('#tut-avl > div.col-sm-9');
        if ($availableAidDom->count()) {
            $item->setAvailableAid(self::trimText($availableAidDom->text(null, false)));
        }

        return $item;
    }
}