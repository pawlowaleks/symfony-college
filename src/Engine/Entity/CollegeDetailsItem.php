<?php


namespace App\Engine\Entity;


/**
 * Class DetailsItem
 * @package App\Engine\Entity
 */
class CollegeDetailsItem extends CollegeItem
{

    /** @var string|null $address Адрес */
    private ?string $address;

    /** @var string|null $phone Телефон */
    private ?string $phone;

    /** @var string|null $site Url сайта колледжа */
    private ?string $site;

    /** @var string|null $email */
    private ?string $email;

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * @param string|null $contact
     */
    public function setContact(?string $contact): void
    {
        $this->contact = $contact;
    }

    /** @var string|null $contact */
    private ?string $contact;


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

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            $this->getTitle(),
            $this->getAddress(),
            $this->getPhone(),
            $this->getSite()
        ];
    }

    /**
     * @return string[]
     */
    public static function getTitleLabels(): array
    {
        return ['Title', 'Address', 'Phone', 'Site'];
    }


}