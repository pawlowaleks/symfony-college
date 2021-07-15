<?php

namespace App\Engine\Entity;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

/**
 * Class ListResult
 * @package App\Engine\Entity
 */
class ListResult implements Countable, IteratorAggregate, ListResultInterface
{
    /**
     * @var int $count
     */
    private int $count;

    /**
     * @var array $items
     */
    private array $items = [];

    /**
     * @var string|null
     */
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

    /**
     * @var array
     */
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

    /**
     * @param ListItem $item
     */
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

    /**
     * @return string[]
     */
    public static function getTitleLabels(): array
    {
        return ['Title', 'City', 'State', 'Image'];
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        $array = [];
        foreach ($this->getItems() as $item) {
            $array[] = $item->asArray();
        }
        return $array;
    }

    /**
     * @param string $url
     */
    public function addDetailsUrl(string $url): void
    {
        $this->detailUrls[] = $url;
    }

}