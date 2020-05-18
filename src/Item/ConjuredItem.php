<?php
declare(strict_types=1);

namespace App\Item;

use App\Item\Utils\ItemUtils;

final class ConjuredItem extends CommonItem
{
    public function updateValues(): void
    {
        $qualityDecrease = 2;
        if ($this->item->sell_in < 1) {
            $qualityDecrease = 4;
        }

        $this->item->quality = ItemUtils::decrease($this->item->quality, $qualityDecrease);
        $this->item->sell_in = ItemUtils::decrease($this->item->sell_in, 1);
    }
}
