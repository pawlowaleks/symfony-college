<?php

namespace App\Engine\College;

use App\Engine\Entity\DetailsItem;
use App\Engine\Entity\DetailsItemInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class DetailsParser
 * @package App\Engine\College
 */
class DetailsParser
{
    /**
     * @param string $url
     * @param string $content
     * @return DetailsItem|null
     */
    public function parse(string $url, string $content): ?DetailsItemInterface
    {
        $crawler = new Crawler($content, $url);

        $headerDom = $crawler->filterXPath('//*[@id="SchoolProfileHeader2017"]/section/div/div[1]');
        if (!$headerDom->count()) {
            $headerDom = $crawler->filterXPath('//*[@id="tpr-schools"]/div[10]/div/div[1]/div[2]/div/div[2]/div/div[1]');
            if (!$headerDom->count()) {
//                $this->errors[] = "Empty headerDom";
                return null;
            }
        }

        $detailsItem = new DetailsItem();

        $titleDom = $headerDom->filter('h1 > span');
        if ($titleDom->count()) {
            $detailsItem->setTitle($titleDom->text());
        } else {
//            $this->errors[] = "Empty title";
            return null;
        }

        $addressDom = $headerDom->filter('div > div > span:nth-child(1)');
        if ($addressDom->count()) {
            $detailsItem->setAddress($addressDom->text());
        }

        $detailsItem->setPhone(self::findPhone($crawler));

        $siteDom = $headerDom->filter('div > div > a');
        if ($siteDom->count()) {
            $detailsItem->setSite($siteDom->attr('href'));
        }

//        $det

        return $detailsItem;
    }

    /**
     * Найти номер телефона
     * @param Crawler $crawler
     * @return string|null
     */
    private static function findPhone(Crawler $crawler): ?string
    {
        if (!$crawler->filter('div.contacts-block')->count()) {
            return null;
        }
        $contactsDom = $crawler->filter('div.school-contacts > div:nth-child(1) > div.col-sm-9 > div.row')->each(function ($node, $i) {
            return $node->text();
        });
        $phone = null;
        foreach ($contactsDom as $text) {
            if (strpos($text, 'Phone') !== false) {
                $phone = trim(mb_substr($text, 6));
                break;
            }
        }
        return $phone;
    }

}