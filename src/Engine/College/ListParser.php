<?php


namespace App\Engine\College;


use App\Engine\ListItem;
use App\Engine\ListResult;
use Symfony\Component\DomCrawler\Crawler;

class ListParser
{

    public function parse(string $url, string $content): ?ListResult
    {
        $crawler = new Crawler($content, $url);
        $colleges = $crawler->filter('#filtersForm > div.col-sm-9.desktop-74p-width')->filter('div.row.vertical-padding');

        $this->tableRows = [];

        $listResult = new ListResult(0, []);

        foreach ($colleges as $collegeSelector) {
            $element = new Crawler($collegeSelector, $url);
            $listItem = $this->parseItem($element);
            if (!empty($listItem)) {
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

    private function parseItem(Crawler $element): ?ListItem
    {
        $listItem = new ListItem();

        $titleDom = $element->filter('div > div > div > h2 > a');
        if (!$titleDom->count()) {
//            $this->errors[] = "Empty title";
            return null;
        }
        $listItem->setTitle($titleDom->text());

//        $detailsUrlDom = $titleDom->link();
//        $this->detailsUrls[] = $detailsUrlDom->getUri();

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

//        if (!empty($array)) {
//            $this->tableRows[] = $array;
//            $collegeRepository = $this->entityManager->getRepository(College::class);
//            $saveResult = $collegeRepository->saveCollege($array['title'], $array['city'], $array['state'], $array['image']);
//            if (!$saveResult) {
//                $this->errors[] = 'Save error';
//                return false;
//            }
//        }
    }

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