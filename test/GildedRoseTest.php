<?php
declare(strict_types=1);

namespace App;

class GildedRoseTest extends \PHPUnit\Framework\TestCase
{
    public function testFoo()
    {
        $item = new Item("foo", 0, 0);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("foo", $item->name);
    }

    public function testAgedBrieItemSellInDecreaseEachTime()
    {
        $item = new Item('Aged Brie', 1, 2);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(0, $item->sell_in);
    }

    public function testAgedBrieQualityIncreasesOlderItGets()
    {
        $item = new Item('Aged Brie', 4, 1);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(2, $item->quality);
    }

    public function testAgedBrieQualityIsNeverMoreThanFifty()
    {
        $item = new Item('Aged Brie', 4, 50);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(50, $item->quality);
    }

    public function testBackstagePassItemSellInDecreaseEachTime()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 1, 2);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(0, $item->sell_in);
    }

    public function testBackstagePassQualityIncreasesByTwoWhenTenDaysOrLessLeft()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 0);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(2, $item->quality);
    }

    public function testBackstagePassQualityIncreasesByThreeWhenFiveDaysOrLessLeft()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 0);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(3, $item->quality);
    }

    public function testBackstagePassQualityDropsToZeroAfterConcert()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(0, $item->quality);
    }

    public function testSulfurasItemNeverChangesValues()
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', -1, 80);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(80, $item->quality);
        static::assertEquals(-1, $item->sell_in);
        static::assertEquals('Sulfuras, Hand of Ragnaros', $item->name);
    }

    public function testSulfurasItemSellInNeverDecrease()
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 1, 2);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(1, $item->sell_in);
    }

    public function testStandardItemSellInDecreaseEachTime()
    {
        $item = new Item('standard', 1, 2);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(0, $item->sell_in);
    }

    public function testStandardItemQualityDecreasesEachTime()
    {
        $item = new Item("standard", 1, 2);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(1, $item->quality);
    }

    public function testQualityDecreasesWhenSellDatePassed()
    {
        $item = new Item("standard", 0, 5);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(3, $item->quality);
    }

    public function testQualityIsNeverNegative()
    {
        $item = new Item("standard", 4, 1);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        static::assertEquals(0, $item->quality);
    }
}
