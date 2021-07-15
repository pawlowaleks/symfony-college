<?php

namespace App\Engine\Entity;

/**
 * Interface ListResultInterface
 * @package App\Engine\Entity
 */
interface ListResultInterface
{

    /**
     * @return array
     */
    public static function getTitleLabels(): array;

    /**
     * @return string|null
     */
    public function getNextUrl(): ?string;

    /**
     * @param string|null $nextUrl
     */
    public function setNextUrl(?string $nextUrl): void;

    /**
     * @return array
     */
    public function getDetailUrls(): array;

    /**
     * @param array $detailUrls
     */
    public function setDetailUrls(array $detailUrls): void;

    /**
     * @param ListItem $item
     */
    public function addItem(ListItem $item): void;

    /**
     * @return array
     */
    public function getItems(): array;

    /**
     * @return array
     */
    public function asArray(): array;

    /**
     * @param string $url
     */
    public function addDetailsUrl(string $url): void;

}