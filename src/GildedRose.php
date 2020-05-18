<?php
declare(strict_types=1);

namespace App;

use App\Item\Item;
use App\Item\ItemNames;

final class GildedRose
{
    public const HIGHEST_QUALITY_POSSIBLE = 50;
    public const LOWEST_QUALITY_POSSIBLE = 0;

    /**
     * @var Item[]
     */
    private $items = [];

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality()
    {
        foreach ($this->items as $item) {
            if (!in_array($item->name, [ItemNames::AGED_BRIE, ItemNames::BACKSTAGE_PASS])) {
                if ($item->quality > self::LOWEST_QUALITY_POSSIBLE and $item->name != ItemNames::SULFURAS) {
                    $item->quality = $item->quality - 1;
                }
            } else {
                if ($item->quality < self::HIGHEST_QUALITY_POSSIBLE) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == ItemNames::BACKSTAGE_PASS) {
                        if ($item->sell_in < 11) {
                            $item->quality = $item->quality + 1;
                        }
                        if ($item->sell_in < 6) {
                            $item->quality = $item->quality + 1;
                        }
                    }
                }
            }

            if ($item->name != ItemNames::SULFURAS) {
                $item->sell_in = $item->sell_in - 1;
            }

            if ($item->sell_in < 0) {
                if ($item->name != ItemNames::AGED_BRIE) {
                    if ($item->name != ItemNames::BACKSTAGE_PASS) {
                        if ($item->quality > self::LOWEST_QUALITY_POSSIBLE and $item->name != ItemNames::SULFURAS) {
                            $item->quality = $item->quality - 1;
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < self::HIGHEST_QUALITY_POSSIBLE) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}

