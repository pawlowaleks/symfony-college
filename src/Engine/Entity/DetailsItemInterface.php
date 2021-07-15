<?php

namespace App\Engine\Entity;

/**
 * Interface DetailsItemInterface
 * @package App\Engine\Entity
 */
interface DetailsItemInterface extends ItemInterface
{
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
    public function getAddress(): ?string;

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void;

    /**
     * @return string|null
     */
    public function getPhone(): ?string;

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void;

    /**
     * @return string|null
     */
    public function getSite(): ?string;

    /**
     * @param string|null $site
     */
    public function setSite(?string $site): void;

    public function asArray(): array;

}