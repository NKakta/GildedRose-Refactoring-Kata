<?php
declare(strict_types=1);

namespace App;

use App\Item\Contracts\CustomItem;
use App\Item\Item;
use App\Item\ItemFactory;

final class GildedRose
{
    /**
     * @var CustomItem[]
     */
    private $items = [];

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality()
    {
        foreach ($this->items as $item) {
            $item = $this->prepareItem($item);
            $item->updateValues();
        }
    }

    public function prepareItem(Item $item): CustomItem
    {
        return (new ItemFactory($item))->makeItem();
    }
}

