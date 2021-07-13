<?php


namespace App\Service;


use App\Entity\College;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Throwable;

class CollegeFetchDetailsService
{

    /** @var array $errors Массив с ощибками */
    private $errors;

    private $entityManager;

    /** @var array $collegeDetailsArray Массив с детальной информацией о Колледже для вывода в консоли */
    private $collegeDetailsArray;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function getLastError(): ?string
    {
        return end($this->errors);
    }


    public function getTableRow(): ?array
    {
        return $this->collegeDetailsArray;
    }


    /**
     * @param string $url Url с детальной информацией о колледже ['title', 'address', 'phone', 'site']
     * @return bool
     */
    public function fetchDetails(string $url): bool
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
        } catch (Throwable $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }

        $array = [
            'title' => null,
            'address' => null,
            'phone' => null,
            'site' => null
        ];

        $crawler = new Crawler($content);

        $headerDom = $crawler->filterXPath('//*[@id="SchoolProfileHeader2017"]/section/div/div[1]');
        if (!$headerDom->count()) {
            $headerDom = $crawler->filterXPath('//*[@id="tpr-schools"]/div[10]/div/div[1]/div[2]/div/div[2]/div/div[1]');
            if (!$headerDom->count()) {
                $this->errors[] = "Empty headerDom";
                return false;
            }
        }

        $titleDom = $headerDom->filter('h1 > span');
        if ($titleDom->count()) {
            $array['title'] = $titleDom->text();
        } else {
            $this->errors[] = "Empty title";
            return false;
        }

        $addressDom = $headerDom->filter('div > div > span:nth-child(1)');
        if ($addressDom->count()) {
            $array['address'] = $addressDom->text();
        }

        $array['phone'] = self::findPhone($crawler);

        $siteDom = $headerDom->filter('div > div > a');
        if ($siteDom->count()) {
            $array['site'] = $siteDom->attr('href');
        }

        $this->collegeDetailsArray = $array;

        $collegeRepository = $this->entityManager->getRepository(College::class);

        $saveResult = $collegeRepository->saveCollegeDetails($array['title'], $array['address'], $array['phone'], $array['site']);
        if (!$saveResult) {
            $this->errors[] = 'Save error';
            return false;
        }
        return true;

    }

    /**
     * Получить номер телефона
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