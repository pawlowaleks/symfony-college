<?php

namespace App\Engine\Parser;

use App\Engine\Entity\CollegeListItem;
use App\Engine\Entity\CollegeListResult;
use App\Entity\Major;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class ListParser
 * @package App\Engine\College
 */
class CollegeListParser extends AbstractParser
{

    /**
     * @param string $url
     * @param string $content
     * @param Major|null $major
     * @return CollegeListResult|null
     */
    public function parse(string $url, string $content, ?Major $major = null): ?CollegeListResult
    {
        $crawler = new Crawler($content, $url);
        $colleges = $crawler->filter('#filtersForm > div.col-sm-9.desktop-74p-width')->filter('div.row.vertical-padding');

        $this->tableRows = [];

        $listResult = new CollegeListResult(0, []);

        foreach ($colleges as $collegeSelector) {
            $element = new Crawler($collegeSelector, $url);
            $listItem = $this->parseItem($element);
            if (!empty($listItem)) {
                $listItem->setMajor($major);
                $listResult->addItem($listItem);

                $detailsUrl = $listItem->getDetailsUrl();
                if (!empty($detailsUrl)) {
                    $listResult->addDetailsUrl($detailsUrl);
                }
            }
        }

        $listResult->setNextUrl($this->findNextUrl($crawler));

        return $listResult;
    }

    /**
     * @param Crawler $element
     * @return CollegeListItem|null
     */
    private function parseItem(Crawler $element): ?CollegeListItem
    {
        $listItem = new CollegeListItem();

        $titleDom = $element->filter('div > div > div > h2 > a');
        if (!$titleDom->count()) {
//            $this->errors[] = "Empty title";
            return null;
        }
        $listItem->setTitle($titleDom->text());

        $imageDom = $element->filter('div > a > img');
        if ($imageDom->count()) {
            $listItem->setImage($imageDom->image()->getUri());
        }

        $locationDom = $element->filter('div > div> div > div.location');
        if ($locationDom->count()) {
            $locationString = $locationDom->text();
            $locationArray = explode(', ', $locationString);

            $listItem->setCity($locationArray[0] ?? null);
            $listItem->setState($locationArray[1] ?? null);
        }

        $listItem->setDetailsUrl($this->findDetailsUrl($element));

        return $listItem;
    }

    /**
     * @param Crawler $element
     * @return string|null
     */
    private function findDetailsUrl(Crawler $element): ?string
    {
        $titleDom = $element->filter('div > div > div > h2 > a');
        if (!$titleDom->count()) {
            return null;
        }
        return $titleDom->link()->getUri();
    }

    /**
     * Найти url следующей страницы со списком Колледжей
     * @param Crawler $crawler Текущая страница
     * @return string|null Url следующей страницы со списком Колледжей
     */
    private function findNextUrl(Crawler $crawler): ?string
    {
        if (!$crawler->selectLink('Next >')->count()) {
            return null;
        }
        return $crawler->selectLink('Next >')->link()->getUri();
    }

}