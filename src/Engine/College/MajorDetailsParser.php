<?php

namespace App\Engine\College;

use App\Engine\Entity\MajorDetailsItem;
use Symfony\Component\DomCrawler\Crawler;

class MajorDetailsParser
{

    private MajorDetailsItem $majorDetailsItem;

    public function __construct()
    {
        $this->majorDetailsItem = new MajorDetailsItem();
    }

    /**
     * @param string $url
     * @param string $content
     * @return MajorDetailsItem
     */
    public function parse(string $url, string $content, ?MajorDetailsItem $parentMajor = null): MajorDetailsItem
    {
        $crawler = new Crawler($content, $url);

        $domLink = $crawler->filter('#tpr-majors > div:nth-child(17) > div.row > div.col-md-8 > div.row > div > a');
        $link = $domLink->link();

        $this->majorDetailsItem->setCollegesUrl($link->getUri());
        $this->majorDetailsItem->setParentMajor($parentMajor);

        return $this->majorDetailsItem;
    }


}