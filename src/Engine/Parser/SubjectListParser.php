<?php

namespace App\Engine\Parser;

use App\Engine\Entity\SubjectItem;
use App\Engine\Entity\SubjectResult;
use DOMElement;
use Symfony\Component\DomCrawler\Crawler;

class SubjectListParser extends AbstractParser
{

    private string $url;

    private ?SubjectResult $subjectResult = null;

    /**
     * @inheritDoc
     */
    public function parse(string $url, string $content): ?SubjectResult
    {
        $this->setUrl($url);

        $crawler = new Crawler($content, $url);

        $this->subjectResult = new SubjectResult();

        $categoriesDom = $crawler->filter('#page-subjects > div.contain-page > section.width-page.small-down-padding-horz-medium > ul > li');
        foreach ($categoriesDom as $categoryDom) {
            $this->parseCategory($categoryDom, $url);
        }

        return $this->subjectResult;
    }

    /**
     * @param DOMElement $element
     * @param string $url
     * @return bool
     */
    private function parseCategory(DOMElement $element, string $url): bool
    {
        $crawler = new Crawler($element, $url);

        $parentSubjectItem = new SubjectItem();

        $parentLinkDom = $crawler->filter('h3 > a.border-box.align-middle.color-charcoal.hover-no-underline');
        $parentLink = $parentLinkDom->link();

        $parentUrl = $parentLink->getUri();

        $parentTitleDom = $parentLinkDom->filter('span');

        $parentTitle = $parentTitleDom->text();


        $parentSubjectItem->setTitle($parentTitle);
        $parentSubjectItem->setUrl($parentUrl);

        $childSubjectsDom = $crawler->filter('ul > li');
        $this->parseChildSubjects($childSubjectsDom, $parentSubjectItem);

        return true;
    }

    /**
     * @param Crawler $items
     * @param SubjectItem $parentSubjectItem
     * @return bool
     */
    private function parseChildSubjects(Crawler $items, SubjectItem $parentSubjectItem): bool
    {
        foreach ($items as $item) {
            $childSubject = $this->parseChildSubject($item, $parentSubjectItem);

            $this->subjectResult->addSubjectItem($childSubject);
        }

        return true;
    }

    /**
     * @param DOMElement $element
     * @param SubjectItem $parentSubjectItem
     * @return SubjectItem|null
     */
    private function parseChildSubject(DOMElement $element, SubjectItem $parentSubjectItem): ?SubjectItem
    {
        $crawler = new Crawler($element, $this->getUrl());

        $linkDom = $crawler->filter('a');
        $link = $linkDom->link();

        $title = $linkDom->text();
        $url = $link->getUri();


        $subjectItem = new SubjectItem();

        $subjectItem->setTitle($title);
        $subjectItem->setUrl($url);
        $subjectItem->setParentSubjectItem($parentSubjectItem);

        return $subjectItem;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

}