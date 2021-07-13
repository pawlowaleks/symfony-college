<?php


namespace App\Engine;


class DetailsItem extends Item
{

    /** @var string|null $address Адрес */
    private ?string $address;

    /** @var string|null $phone Телефон */
    private ?string $phone;

    /** @var string|null $site Url сайта колледжа */
    private ?string $site;

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getSite(): ?string
    {
        return $this->site;
    }

    /**
     * @param string|null $site
     */
    public function setSite(?string $site): void
    {
        $this->site = $site;
    }



}