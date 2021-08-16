<?php


namespace App\Engine\Entity;


use App\Entity\Major;

/**
 * Class ListItem
 * @package App\Engine\Entity
 */
class CollegeListItem extends CollegeItem
{

    /**
     * @var ?string $city Город
     */
    private ?string $city;

    /**
     * @var ?string $state Штат
     */
    private ?string $state;

    /**
     * @var ?string $image Url фото
     */
    private ?string $image;

    /**
     * @var string|null
     */
    private ?string $detailsUrl;

    private ?Major $major;

    /**
     * @return Major|null
     */
    public function getMajor(): ?Major
    {
        return $this->major;
    }

    /**
     * @param Major|null $major
     */
    public function setMajor(?Major $major): void
    {
        $this->major = $major;
    }

    /**
     * @return string|null
     */
    public function getDetailsUrl(): ?string
    {
        return $this->detailsUrl;
    }

    /**
     * @param string|null $detailsUrl
     */
    public function setDetailsUrl(?string $detailsUrl): void
    {
        $this->detailsUrl = $detailsUrl;
    }

    /**
     * ListItem constructor.
     */
    public function __construct()
    {
        $this->city = null;
        $this->state = null;
        $this->image = null;
        $this->detailsUrl = null;
        $this->major = null;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     */
    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            $this->getTitle(),
            $this->getCity(),
            $this->getState(),
            $this->getImage(),
            empty($this->getMajor()) ? null : $this->getMajor()->getTitle()
        ];
    }

}