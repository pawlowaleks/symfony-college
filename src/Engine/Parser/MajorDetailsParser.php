<?php

namespace App\Engine\Parser;

use App\Engine\Entity\MajorDetailsItem;
use Symfony\Component\DomCrawler\Crawler;

class MajorDetailsParser extends AbstractParser
{

    private MajorDetailsItem $majorDetailsItem;

    public function __construct()
    {
        $this->majorDetailsItem = new MajorDetailsItem();
    }

    /**
     * @param string $url
     * @param string $content
     * @param MajorDetailsItem|null $parentMajor
     * @return MajorDetailsItem
     */
    public function parse(string $url, string $content, ?MajorDetailsItem $parentMajor = null): ?MajorDetailsItem
    {
        $crawler = new Crawler($content, $url);

        $domLink = $crawler->filter('div.major-popular-schools-block > a');
        if ($domLink->count()) {
            $link = $domLink->link();
        } else {
            var_dump('Empty link');
            return null;
        }

        $this->majorDetailsItem->setCollegesUrl($link->getUri());
        $this->majorDetailsItem->setParentMajor($parentMajor);

        return $this->majorDetailsItem;
    }


}