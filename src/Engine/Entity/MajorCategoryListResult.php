<?php

namespace App\Engine\Entity;

class MajorCategoryListResult
{

    private array $items = [];


    public function addItem(MajorCategoryListItem $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function asArray(): array
    {
        $array = [];
        foreach ($this->getItems() as $item) {
            $array[] = $item->asArray();
        }
        return $array;
    }

}