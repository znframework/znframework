<?php namespace ZN\DateTime;

use Date;

class DateTest extends \PHPUnit\Framework\TestCase
{
    public function testSet()
    {
       $this->assertSame(Date::now(), Date::set('{y}-{mn0}-{dn0} {hour}:{min}:{second}'));
    }

    public function testCalculate()
    {
        $this->assertSame('2020-10-30', Date::calculate('2020-11-30', '-1 month'));
        $this->assertSame('30-10-2020', Date::calculate('2020-11-30', '-1 month', '{dn}-{mn}-{y}'));
    }

    public function testCompare()
    {
        $this->assertTrue(Date::compare('2020', '>', '2019'));
    }

    public function testToNumeric()
    {
        $this->assertIsInt(Date::toNumeric('2020-10-05'));
    }

    public function testToReadable()
    {
        $this->assertIsString(Date::toReadable(1601848800, '{y}-{mn0}-{dn0}'));
    }

    public function testConvert()
    {
        $this->assertSame('2020-20-05', Date::convert('20-05-2020', '{y}-{dn0}-{mn0}'));
    }

    public function testStandart()
    {
        $this->assertIsString(Date::standart());
    }

    public function testCurrent()
    {
        $this->assertSame(Date::set('{dn0}.{mn0}.{y}'), Date::current());
    }

    public function testIsPast()
    {
        $this->assertTrue(Date::isPast('2020-10-30'));
        $this->assertFalse(Date::isPast('9999-10-30')); # Maybe it will reach those years :)
    }

    public function testNow()
    {
        $this->assertSame(Date::set('Y-m-d H:i:s'), Date::now());
    }

    public function testIsDay()
    {
        $this->assertTrue(Date::isSaturday('2021-01-23'));
        $this->assertFalse(Date::isSaturday('2021-01-24'));
    }

    public function testIsMonth()
    {
        $this->assertTrue(Date::isJanuary('2021-01-23'));
        $this->assertFalse(Date::isJanuary('2021-02-23'));
    }

    public function testIsWeekend()
    {
        $this->assertTrue(Date::isWeekend('2021-01-23'));
        $this->assertFalse(Date::isWeekend('2021-01-22'));
    }

    public function testToday()
    {
        $this->assertSame('Saturday', Date::today('2021-01-23'));
    }

    public function testTodayNumber()
    {
        $this->assertSame('23', Date::todayNumber('2021-01-23'));
    }

    public function testNextDay()
    {
        $this->assertSame('Sunday', Date::nextDay('2021-01-23'));
    }

    public function testNextDayNumber()
    {
        $this->assertSame('24', Date::nextDayNumber('2021-01-23'));
    }

    public function testPrevDay()
    {
        $this->assertSame('Friday', Date::prevDay('2021-01-23'));
    }

    public function testPrevDayNumber()
    {
        $this->assertSame('22', Date::prevDayNumber('2021-01-23'));
    }

    public function testAddDay()
    {
        $this->assertSame('2021-01-25', Date::addDay('2021-01-23', 2));
    }

    public function testRemoveDay()
    {
        $this->assertSame('2021-01-21', Date::removeDay('2021-01-23', 2));
    }

    public function testDiffDay()
    {
        $this->assertSame(4, (int) Date::diffDay('2021-01-23', '2021-01-27'));
    }
}