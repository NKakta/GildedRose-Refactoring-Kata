<?php
declare(strict_types=1);

namespace App\Item\Utils;


final class ItemUtils
{
    const HIGHEST_POSSIBLE_QUALITY = 50;

    static function decrease(int $value, int $by): int
    {
        if ($value > $by)
        {
            return $value - $by;
        }

        return 0;
    }

    static function increase(int $value, int $by): int
    {
        if ($value < self::HIGHEST_POSSIBLE_QUALITY)
        {
            return $value + $by;
        }

        return self::HIGHEST_POSSIBLE_QUALITY;
    }
}
