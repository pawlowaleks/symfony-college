<?php


namespace App\Engine\Entity;


/**
 * Class ListItem
 * @package App\Engine\Entity
 */
class ListItem extends Item implements ListItemInterface
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
    public function asArray(): array
    {
        return [
            $this->getTitle(),
            $this->getCity(),
            $this->getState(),
            $this->getImage()
        ];
    }

}