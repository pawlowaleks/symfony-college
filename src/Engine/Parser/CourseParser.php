<?php

namespace App\Engine\Parser;

use App\Engine\Entity\CourseItem;
use App\Engine\Entity\CourseResult;
use App\Engine\Entity\SubjectItem;
use DOMElement;
use Symfony\Component\DomCrawler\Crawler;

class CourseParser implements ParserInterface
{

    public function parse(string $url, string $content, SubjectItem $subjectItem = null): ?CourseResult
    {
        $crawler = new Crawler($content, $url);

        $courseListDom = $crawler->filter('#course-listing-tbody > tr.border-gray-light');

        // row nowrap padding-vert-small vert-align-middle border-bottom border-gray-light
        // row nowrap vert-align-middle bg-blue-xlight

        $courseResult = new CourseResult();

        foreach ($courseListDom as $courseDom) {
            $courseItem = $this->parseCourse($courseDom, $url, $subjectItem);
//            $courseItem->setSubjectItem($subjectItem);

            $courseResult->addCourseItem($courseItem);
        }

        $nextUrlDom = $crawler->filter('#page-subject > div.contain-page > div:nth-child(4) > section.listing-table > div > div.border-box.width-100.large-up-width-3-4.tables-wrap.border-top.border-gray-light > div > button');
//        $nextUrlDom-

        return $courseResult;
    }

    private function parseCourse(DOMElement $element, string $url, SubjectItem $subjectItem = null): CourseItem
    {
        $crawler = new Crawler($element, $url);

        $linkDom = $crawler->filter('td.width-12-16.relative > a');
        $link = $linkDom->link();
        $urlDetails = $link->getUri();
        $title = $linkDom->text();

        $courseItem = new CourseItem();
        $courseItem->setTitle($title);
        $courseItem->setUrlDetails($urlDetails);
        $courseItem->setSubjectItem($subjectItem);
        return $courseItem;
    }
}