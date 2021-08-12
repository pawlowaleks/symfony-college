<?php


namespace App\Engine\Entity;


/**
 * Class Item
 * @package App\Engine\Entity
 */
class CollegeItem extends AbstractEntity
{


    /**
     * @var string $title Название колледжа
     */
    protected string $title;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    /**
     * @return array
     */
    public function asArray(): array
    {
        return [
            $this->getTitle()
        ];
    }

    /**
     * @return array
     */
    public static function getTitleLabels(): array
    {
        return ['Title'];
    }
}