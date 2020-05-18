<?php
declare(strict_types=1);

namespace App\Item;

use App\Item\Utils\ItemUtils;

final class AgedBrie extends CommonItem
{
    public function updateValues(): void
    {
        $this->item->quality = ItemUtils::increase($this->item->quality, 1);
        $this->item->sell_in = ItemUtils::decrease($this->item->sell_in, 1);
    }
}
