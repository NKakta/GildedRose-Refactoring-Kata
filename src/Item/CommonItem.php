<?php
declare(strict_types=1);

namespace App\Item;

use App\Item\Contracts\CustomItem;
use App\Item\Utils\ItemUtils;

class CommonItem implements CustomItem
{

    /**
     * @var Item
     */
    protected $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function updateValues(): void
    {
        $qualityDecrease = 1;
        if ($this->item->sell_in < 1) {
            $qualityDecrease = 2;
        }

        $this->item->quality = ItemUtils::decrease($this->item->quality, $qualityDecrease);
        $this->item->sell_in = ItemUtils::decrease($this->item->sell_in, 1);
    }
}
