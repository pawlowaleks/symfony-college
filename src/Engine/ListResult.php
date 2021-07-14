<?php

namespace App\Engine;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

class ListResult implements Countable, IteratorAggregate
{
    /**
     * @var int $count
     */
    private int $count;

    /**
     * @var array $items
     */
    private array $items = [];

    private ?string $nextUrl = null;

    /**
     * @return string|null
     */
    public function getNextUrl(): ?string
    {
        return $this->nextUrl;
    }

    /**
     * @param string|null $nextUrl
     */
    public function setNextUrl(?string $nextUrl): void
    {
        $this->nextUrl = $nextUrl;
    }

    /**
     * @return array
     */
    public function getDetailUrls(): array
    {
        return $this->detailUrls;
    }

    /**
     * @param array $detailUrls
     */
    public function setDetailUrls(array $detailUrls): void
    {
        $this->detailUrls = $detailUrls;
    }

    private array $detailUrls = [];

    /**
     * ListResult constructor.
     * @param int $count
     * @param Item|array $items
     */
    public function __construct(int $count, array $items)
    {
        $this->count = $count;
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * @return Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->count;
    }

    public function addItem(ListItem $item): void
    {
        $this->items[] = $item;
//        $this->count = count($this->items);
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public static function getTitleLabels(): array
    {
        return ['Title', 'City', 'State', 'Image'];
    }

    public function asArray(): array
    {
        $array = [];
        foreach ($this->getItems() as $item) {
            $array[] = $item->asArray();
        }
        return $array;
    }

    public function addDetailsUrl(string $url): void
    {
        $this->detailUrls[] = $url;
    }

}