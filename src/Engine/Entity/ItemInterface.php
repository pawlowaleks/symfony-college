<?php


namespace App\Engine\Entity;


/**
 * Interface ItemInterface
 * @package App\Engine\Entity
 */
interface ItemInterface
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
     * @return array
     */
    public function asArray(): array;

}