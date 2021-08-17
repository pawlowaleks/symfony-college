<?php

namespace App\Engine\College;

use App\Engine\Entity\MajorCategoryListItem;
use App\Engine\Entity\MajorCategoryListResult;
use App\Engine\Parser\AbstractParser;
use DOMElement;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;

class MajorCategoryParser extends AbstractParser
{

    private MajorCategoryListResult $majorCategoryListResult;

    private ?MajorCategoryListItem $parentMajor;

    public function __construct()
    {
        $this->majorCategoryListResult = new MajorCategoryListResult();
    }

    /**
     * @param string $url
     * @param string $content
     * @return MajorCategoryListResult
     */
    public function parse(string $url, string $content): ?MajorCategoryListResult
    {
        $crawler = new Crawler($content, $url);

        $domColumns = $crawler->filter('#tpr-majors > form > div.container > div.row.columned-list > div > div');
        foreach ($domColumns as $domColumn) {
            $this->parseColumn($domColumn, $url);
        }

        return $this->majorCategoryListResult;
    }

    /**
     * @param DOMElement $element
     * @param string $url
     * @return bool
     */
    private function parseColumn(DOMElement $element, string $url): bool
    {
        $crawler = new Crawler($element, $url);

        $domLinks = $crawler->filter('a');
        $links = $domLinks->links();
        foreach ($links as $link) {
            $majorItem = $this->parseItem($link);
            $this->majorCategoryListResult->addItem($majorItem);
        }

        return true;
    }

    /**
     * @param Link $link
     * @return MajorCategoryListItem
     */
    private function parseItem(Link $link): MajorCategoryListItem
    {
        $majorItem = new MajorCategoryListItem();
        $majorItem->setUrl($link->getUri());
        $majorItem->setTitle($link->getNode()->textContent);
        $majorItem->setParentMajor($this->getParentMajor());
        return $majorItem;
    }

    /**
     * @return MajorCategoryListItem|null
     */
    public function getParentMajor(): ?MajorCategoryListItem
    {
        return $this->parentMajor;
    }

    /**
     * @param MajorCategoryListItem|null $parentMajor
     */
    public function setParentMajor(?MajorCategoryListItem $parentMajor): void
    {
        $this->parentMajor = $parentMajor;
    }

}