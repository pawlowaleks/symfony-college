<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CollegeController extends AbstractController
{

//    private $client;
//
//    public function __construct(HttpClientInterface $client)
//    {
//        $this->client = $client;
//    }

    public function check(): Response
    {
        $url = 'https://www.princetonreview.com/college-search?ceid=cp-1022984';

        $httpClient = HttpClient::create();

        $response = $httpClient->request(
            'GET',
            $url
        );

        $content = $response->getContent();

        $crawler = new Crawler($content);

        $collegeDom = $crawler->filterXPath('//*[@id="filtersForm"]/div[2]/div[4]');


        //Ссылка на картинку | Название Колледжа | Город | Штат

        $imageDom = $collegeDom->filter('div > a > img');
        $imageUrl = $imageDom->attr('src');

        $titleDom = $collegeDom->filter('div > div.row > div.col-sm-9 > h2 > a');
        $title = $titleDom->text();

        $locationDom = $collegeDom->filter('div.school-col > div.row > div.col-sm-9 > div.location');
        $locationString = $locationDom->text();

        $locationArray = explode(', ', $locationString);

        $city = $locationArray[0] ?? null;
        $state = $locationArray[1] ?? null;

        $responseString  = "image={$imageUrl}<br>title={$title}<br>city={$city}<br>state={$state}";
        return new Response($responseString);
    }

    public function details(): Response
    {
        $url = 'https://www.princetonreview.com/college/harvard-college-1022984?ceid=cp-1022984';

        $response = $this->client->request(
            'GET',
            $url
        );

        $content = $response->getContent();

        $crawler = new Crawler($content);
        $collegeDom = $crawler->filterXPath('//*[@id="SchoolProfileHeader2017"]/section/div/div[1]');

        // Название Колледжа | Адрес | Телефон | Сайт

        $titleDom = $collegeDom->filter('h1 > span');
        $title = $titleDom->text();

        $addressDom = $collegeDom->filter('div > div > span:nth-child(1)');
        $address = $addressDom->text();

        $phoneDom = $crawler->filterXPath('//*[@id="tpr-schools"]/div[10]/div/main/section[1]/section[1]/div[3]/div[2]/div[1]/div[2]/div[2]/div[2]');
        $phone = $phoneDom->text();

        $siteDom = $collegeDom->filter('div > div > a');
        $site = $siteDom->attr('href');

        $responseString  = "title={$title}<br>address={$address}<br>phone={$phone}<br>site={$site}";
        return new Response($responseString);


    }

}