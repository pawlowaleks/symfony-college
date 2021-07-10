<?php


namespace App\Service;


use App\Entity\College;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class CollegeFetchDetailsService
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
//        parent::__construct();
    }

    private $collegeDetailsArray;

    public function getTableRow(): ?array
    {
        return $this->collegeDetailsArray;
    }

    /**
     * @param string $url Url с детальной информацией о колледже
     * @return bool
     */
    public function fetchDetails(string $url): bool
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request(
            'GET',
            $url
        );

        $content = $response->getContent();

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
                return false;
            }
        }

        // Название Колледжа | Адрес | Телефон | Сайт

        $titleDom = $headerDom->filter('h1 > span');
        if ($titleDom->count()) {
            $array['title'] = $titleDom->text();
        } else {
            return false;
        }

        $addressDom = $headerDom->filter('div > div > span:nth-child(1)');
        if ($addressDom->count()) {
            $array['address'] = $addressDom->text();
        }

        $phoneDom = $crawler->filterXPath('//*[@id="tpr-schools"]/div[10]/div/main/section[1]/section[1]/div[3]/div[2]/div[1]/div[2]/div[2]/div[2]');
        if ($phoneDom->count()) {
            $array['phone'] = $phoneDom->text();
        }

        $siteDom = $headerDom->filter('div > div > a');
        if ($siteDom->count()) {
            $array['site'] = $siteDom->attr('href');
        }

        $this->collegeDetailsArray = $array;

        $this->saveCollegeDetails($array['title'], $array['address'], $array['phone'], $array['site']);
        return true;

    }

    /**
     * Сохранить детали Колледжа
     * @param string $title
     * @param string|null $address
     * @param string|null $phone
     * @param string|null $site
     * @return bool
     */
    private function saveCollegeDetails(string $title, ?string $address, ?string $phone, ?string $site): bool
    {
        $entityManager = $this->entityManager;

        $college = $entityManager->getRepository(College::class)->findOneByTitle($title);
        if (empty($college)) {
            $college = new College();
            $college->setTitle($title);
        }
        $college->setAddress($address);
        $college->setPhone($phone);
        $college->setSite($site);

        $entityManager->persist($college);
        $entityManager->flush();
        return true;
    }


    private function findPhone(Crawler $crawler): ?string
    {
        if (!$crawler->filter('div.contacts-block')->count()) {
            return null;
        }
        $contactsBlockDom = $crawler->filter('div.contacts-block');

        return $contactsBlockDom->text();
    }
}