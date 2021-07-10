<?php


namespace App\Service;


use App\Entity\College;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class CollegeFetchListService
{

    public const URL_START = 'https://www.princetonreview.com/college-search?ceid=cp-1022984';

    private $entityManager;
    private $tableRows;
    private $nextUrl;

    private $collegeFetchDetailsService;

    public function __construct(EntityManagerInterface $entityManager, CollegeFetchDetailsService $collegeFetchDetailsService)
    {
        $this->entityManager = $entityManager;
        $this->collegeFetchDetailsService = $collegeFetchDetailsService;
//        parent::__construct();
    }

    /**
     * Получить массив Колледжей для вывода в консоли
     * @return array|null
     * @example [['title', 'city', 'state', 'image']]
     */
    public function getTableRows(): ?array
    {
        return $this->tableRows;
    }

    /**
     * Получить url следующей страницы
     * @return string|null
     * @example 'https://www.princetonreview.com/college-search?ceid=cp-1022984&page=2'
     */
    public function getNextUrl(): ?string
    {
        return $this->nextUrl;
    }


    /**
     * Получить Колледжи с сайта
     * @param string $url url сайта со страницей со списком колледжей
     * @return string|null
     */
    public function fetchCollegesFromPage(string $url, bool $fetchDetails = false): bool
    {
        $httpClient = HttpClient::create();

        $response = $httpClient->request(
            'GET',
            $url
        );

        $content = $response->getContent();

        $crawler = new Crawler($content, $url);
        $colleges = $crawler->filter('#filtersForm > div.col-sm-9.desktop-74p-width')->filter('div.row.vertical-padding');

        $this->tableRows = [];

        foreach ($colleges as $collegeSelector) {
            $element = new Crawler($collegeSelector, $url);
            $this->fetchCollege($element);
        }

        $this->nextUrl = $this->findNextUrl($crawler);

        if ($fetchDetails) {
            foreach ($this->tableRows as $tableRow) {
                if (!empty($tableRow['detailsUrl'])) {
                    $this->collegeFetchDetailsService->fetchDetails($tableRow['detailsUrl']);
                }

            }
        }

        return true;
    }

    /**
     * @param Crawler $element
     * @return array|null Массив [['title', 'city', 'state', 'image']]
     */
    private function fetchCollege(Crawler $element): bool
    {

        $array = [
            'title' => null,
            'city' => null,
            'state' => null,
            'image' => null,
            'detailsUrl' => null
        ];

        $titleDom = $element->filter('div > div > div > h2 > a');
        if (!$titleDom->count()) {
            return false;
        }
        $array['title'] = $titleDom->text();
        $detailsUrlDom = $titleDom->link();
        $array['detailsUrl'] = $detailsUrlDom->getUri();


        $imageDom = $element->filter('div > a > img');
        if ($imageDom->count()) {
            $array['image'] = $imageDom->image()->getUri();
        }

        $locationDom = $element->filter('div > div> div > div.location');
        if ($locationDom->count()) {
            $locationString = $locationDom->text();
            $locationArray = explode(', ', $locationString);
            $array['city'] = $locationArray[0] ?? null;
            $array['state'] = $locationArray[1] ?? null;
        }

        if (!empty($array)) {
            $this->tableRows[] = $array;
            $this->saveCollege($array['title'], $array['city'], $array['state'], $array['image']);
        }



        return true;
    }

    /**
     * Сохранить Колледж
     * @param string $title
     * @param string|null $city
     * @param string|null $state
     * @param string|null $image
     * @return bool
     */
    private function saveCollege(string $title, ?string $city, ?string $state, ?string $image = null): bool
    {
        $entityManager = $this->entityManager;

        $college = $entityManager->getRepository(College::class)->findOneByTitle($title);
        if (empty($college)) {
            $college = new College();
            $college->setTitle($title);
        }

        $college->setCity($city);
        $college->setState($state);
        $college->setImage($image);

        $entityManager->persist($college);
        $entityManager->flush();
        return true;
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