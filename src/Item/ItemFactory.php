<?php
declare(strict_types=1);

namespace App\Item;

use App\Item\Contracts\CustomItem;

class ItemFactory
{
    const ITEM_MAP = [
        ItemNames::AGED_BRIE => AgedBrie::class,
        ItemNames::SULFURAS => Sulfuras::class,
        ItemNames::BACKSTAGE_PASS => BackstagePass::class,
        ItemNames::CONJURED => ConjuredItem::class,
    ];

    /**
     * @var Item
     */
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function makeItem(): CustomItem
    {
        $class = static::getItemClass($this->item->name);

        return new $class($this->item);
    }

    public static function getItemClass(string $itemName): string
    {
        if (isset(static::ITEM_MAP[$itemName])) {
            return static::ITEM_MAP[$itemName];
        } else {
            return CommonItem::class;
        }
    }
}
