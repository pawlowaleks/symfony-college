<?php


namespace App\Engine\Entity;


/**
 * Interface ListItemInterface
 * @package App\Engine\Entity
 */
interface ListItemInterface extends ItemInterface
{

    /**
     * @return array
     */
    public static function getTitleLabels(): array;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title
     */
    public function setTitle(string $title): void;

    /**
     * @return string|null
     */
    public function getCity(): ?string;

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void;

    /**
     * @return string|null
     */
    public function getImage(): ?string;

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void;

    /**
     * @return array
     */
    public function asArray(): array;

}