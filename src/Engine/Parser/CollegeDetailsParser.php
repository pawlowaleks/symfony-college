<?php

namespace App\Engine\Parser;

use App\Engine\Entity\CollegeDetailsItem;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class DetailsParser
 * @package App\Engine\College
 */
class CollegeDetailsParser extends AbstractParser
{
    /**
     * @param string $url
     * @param string $content
     * @return CollegeDetailsItem|null
     */
    public function parse(string $url, string $content): ?CollegeDetailsItem
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

        $detailsItem = new CollegeDetailsItem();

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

        $visitsContact = self::findCampusVisitsContact($crawler);
        $detailsItem->setPhone($visitsContact['phone'] ?? null);
        $detailsItem->setContact($visitsContact['contact'] ?? null);
        $detailsItem->setEmail($visitsContact['email'] ?? null);

        $siteDom = $headerDom->filter('div > div > a');
        if ($siteDom->count()) {
            $detailsItem->setSite($siteDom->attr('href'));
        }

        $detailsItem->setCampusVisitingCenter(self::findCampusVisitingCenter($crawler));
        $detailsItem->setCampusTours(self::findCampusTours($crawler));
        $detailsItem->setOnCampusInterview(self::findOnCampusInterview($crawler));


        $collegeAdmissionsParser = new CollegeAdmissionsParser();
        $collegeAdmissionItem = $collegeAdmissionsParser->parse($url, $content);
        if ($collegeAdmissionItem) {
            $detailsItem->setCollegeAdmissionsItem($collegeAdmissionItem);
        }

        $collegeAcademicsParser = new CollegeAcademicsParser();
        $collegeAcademicsItem = $collegeAcademicsParser->parse($url, $content);
        if ($collegeAcademicsItem) {
            $detailsItem->setCollegeAcademicsItem($collegeAcademicsItem);
        }

        $collegeCareersParser = new CollegeCareersParser();
        $collegeCareersItem = $collegeCareersParser->parse($url, $content);
        if ($collegeCareersItem) {
            $detailsItem->setCollegeCareersItem($collegeCareersItem);
        }

        $collegeTuitionParser = new CollegeTuitionParser();
        $collegeTuitionItem = $collegeTuitionParser->parse($url, $content);
        if ($collegeTuitionItem) {
            $detailsItem->setCollegeTuitionItem($collegeTuitionItem);
        }

        $collegeCamusLifeParser = new CollegeCampusLifeParser();
        $collegeCamusLifeItem = $collegeCamusLifeParser->parse($url, $content);
        if ($collegeCamusLifeItem) {
            $detailsItem->setCollegeCampusLifeItem($collegeCamusLifeItem);
        }

        return $detailsItem;
    }

    /**
     * Найти номер телефона
     * @param Crawler $crawler
     * @return string|null
     */
    private static function findCampusVisitsContact(Crawler $crawler): ?array
    {
        if (!$crawler->filter('div.contacts-block')->count()) {
            return null;
        }
        $contactsDom = $crawler->filter('div.school-contacts > div:nth-child(1) > div.col-sm-9 > div.row')->each(function ($node, $i) {
            return $node->text();
        });
        $contact = null;
        $address = null;
        $phone = null;
        $email = null;
        foreach ($contactsDom as $text) {
            if (strpos($text, 'Contact') !== false) {
                $contact = trim(mb_substr($text, 8));
                continue;
            }
            if (strpos($text, 'Address') !== false) {
                $address = trim(mb_substr($text, 8));
                continue;
            }
            if (strpos($text, 'Phone') !== false) {
                $phone = trim(mb_substr($text, 6));
                continue;
            }
            if (strpos($text, 'Email') !== false) {
                $email = trim(mb_substr($text, 6));
                continue;
            }

        }
        return [
            'contact' => $contact,
            'address' => $address,
            'phone' => $phone,
            'email' => $email
        ];
    }

    /**
     * @param Crawler $crawler
     * @return string|null
     */
    private static function findCampusVisitingCenter(Crawler $crawler): ?string
    {
        $divDom = $crawler->filter('div.contacts-block > div.school-contacts > div:nth-child(5) > div.col-sm-9 > div:nth-child(1) > div:nth-child(2)');
        if (!$divDom->count()) {
            return null;
        }
        $text = $divDom->text(null, false);
        return self::trimText($text);
    }

    /**
     * @param Crawler $crawler
     * @return string|null
     */
    private static function findCampusTours(Crawler $crawler): ?string
    {
        $divDom = $crawler->filter('div.contacts-block > div.school-contacts > div:nth-child(5) > div.col-sm-9 > div:nth-child(3) > div:nth-child(2)');
        if (!$divDom->count()) {
            return null;
        }
        $text = $divDom->text(null, false);
        return self::trimText($text);
    }

    /**
     * @param Crawler $crawler
     * @return string|null
     */
    private static function findOnCampusInterview(Crawler $crawler): ?string
    {
        $divDom = $crawler->filter('div.contacts-block > div.school-contacts > div:nth-child(7) > div.col-sm-9');
        if (!$divDom->count()) {
            return null;
        }
        $text = $divDom->text(null, false);
        return self::trimText($text);
    }



}