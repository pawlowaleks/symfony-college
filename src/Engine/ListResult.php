<?php


namespace App\Engine;


use Exception;
use Traversable;

class ListResult implements \Countable, \IteratorAggregate
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
        return new \ArrayIterator($this->items);
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
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

}