<?php
declare(strict_types=1);

namespace App\Item;

use App\Item\Utils\ItemUtils;

final class BackstagePass extends CommonItem
{
    public function updateValues(): void
    {
        $sellIn = $this->item->sell_in;
        $temporaryBy = 0;

        if ($sellIn > 10) {
            $temporaryBy = 1;
        } elseif ($sellIn <= 10 and $sellIn > 5) {
            $temporaryBy = 2;
        } elseif ($sellIn <= 5 and $sellIn >= 1) {
            $temporaryBy = 3;
        }

        if (!$temporaryBy) {
            $this->item->quality = 0;
        } else {
            $this->item->quality = ItemUtils::increase($this->item->quality, $temporaryBy);
        }

        $this->item->sell_in = ItemUtils::decrease($this->item->sell_in, 1);
    }
}
