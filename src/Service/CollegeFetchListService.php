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

    private $detailsUrls;

    private $nextUrl;

    /** @var array $errors Массив с ощибками */
    private $errors;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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

    public function getDetailsUrls(): ?array
    {
        return $this->detailsUrls;
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

    public function getErrors(): ?array
    {
        return $this->errors;
    }
    public function getLastError(): ?string
    {
        return end($this->errors);
    }


    /**
     * Получить Колледжи с сайта
     * @param string $url url сайта со страницей со списком колледжей
     * @return string|null
     */
    public function fetchCollegesFromPage(string $url): bool
    {
        $this->errors = null;
        $httpClient = HttpClient::create();
        try {
            $response = $httpClient->request(
                'GET',
                $url
            );
            if ($response->getStatusCode() != 200) {
                $this->errors[] = "Error connect to {$url}";
                return false;
            }
            $content = $response->getContent();
        } catch(\Throwable $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }



        $crawler = new Crawler($content, $url);
        $colleges = $crawler->filter('#filtersForm > div.col-sm-9.desktop-74p-width')->filter('div.row.vertical-padding');

        $this->tableRows = [];

        foreach ($colleges as $collegeSelector) {
            $element = new Crawler($collegeSelector, $url);
            $this->fetchCollege($element);
        }

        $this->nextUrl = $this->findNextUrl($crawler);

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
        ];


        $titleDom = $element->filter('div > div > div > h2 > a');
        if (!$titleDom->count()) {
            $this->errors[] = "Empty title";
            return false;
        }
        $array['title'] = $titleDom->text();
        $detailsUrlDom = $titleDom->link();
        $this->detailsUrls[] = $detailsUrlDom->getUri();

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
            $collegeRepository = $this->entityManager->getRepository(College::class);
            $saveResult = $collegeRepository->saveCollege($array['title'], $array['city'], $array['state'], $array['image']);
            if (!$saveResult) {
                $this->errors[] = 'Save error';
                return false;
            }
        }

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