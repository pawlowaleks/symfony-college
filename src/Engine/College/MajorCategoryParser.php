<?php

namespace App\Engine\College;

use App\Engine\Entity\MajorCategoryListItem;
use App\Engine\Entity\MajorCategoryListResult;
use DOMElement;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;

class MajorCategoryParser
{

    private MajorCategoryListResult $majorCategoryListResult;

    public function __construct()
    {
        $this->majorCategoryListResult = new MajorCategoryListResult();
    }

    /**
     * @param string $url
     * @param string $content
     * @return MajorCategoryListResult
     */
    public function parse(string $url, string $content): MajorCategoryListResult
    {
        $crawler = new Crawler($content, $url);

//        $domCategories = $crawler->filter('#tpr-majors > form > div.container > div.row.columned-list > div > div:nth-child(2) > a');

        // #tpr-majors > form > div.container > div.row.columned-list > div > div:nth-child(2) > a:nth-child(1)

        $domColumns = $crawler->filter('#tpr-majors > form > div.container > div.row.columned-list > div > div');
        foreach ($domColumns as $domColumn) {
            $this->parseColumn($domColumn, $url);
        }

//        return $majorListResult;


        return $this->majorCategoryListResult;
    }

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
        return $majorItem;
    }

}