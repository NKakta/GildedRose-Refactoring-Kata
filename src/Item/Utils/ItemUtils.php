<?php
declare(strict_types=1);

namespace App\Item\Utils;


final class ItemUtils
{
    const HIGHEST_POSSIBLE_QUALITY = 50;
    const LOWEST_POSSIBLE_QUALITY = 0;

    static function decrease(int $value, int $by): int
    {
        if ($value > $by)
        {
            return $value - $by;
        }

        return self::LOWEST_POSSIBLE_QUALITY;
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
