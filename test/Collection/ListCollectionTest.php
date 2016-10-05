<?php

namespace PhpSlang\Either;

use PhpSlang\Collection\ListCollection;
use PhpSlang\Exception\ImproperCollectionInputException;
use PhpSlang\Exception\NoContentException;
use PhpSlang\Option\None;
use PhpSlang\Option\Some;
use PHPUnit_Framework_TestCase;

class ListCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $this->assertEquals([1, 2], (new ListCollection([1, 2]))->toArray());

        $this->expectException(ImproperCollectionInputException::class);
        (new ListCollection(['aa' => 1]));
    }

    public function testAny()
    {
        $this->assertInstanceOf(Some::class, (new ListCollection([1, 2, 3]))->any(function ($item) {
            return $item == 2;
        }));

        $this->assertInstanceOf(None::class, (new ListCollection([1, 2, 3]))->any(function ($item) {
            return $item == "something";
        }));

        $this->assertEquals(2, (new ListCollection([1, 2, 3]))->any(function ($item) {
            return $item == 2;
        })->getOrElse(100));

        $this->assertEquals(100, (new ListCollection([1, 2000, 3]))->any(function ($item) {
            return $item == 2;
        })->getOrElse(100));
    }

    public function testAvg()
    {
        $this->assertEquals(3, (new ListCollection([1, 2, 3, 4, 5]))->avg()->getOrElse(100));

        $this->assertEquals(100, (new ListCollection([]))->avg()->getOrElse(100));
    }

    public function testCount()
    {
        $this->assertEquals(3, (new ListCollection([1, 2, 3]))->count());

        $this->assertEquals(1, (new ListCollection([1, 2, 3]))->count(function ($item) {
            return $item == 2;
        }));
    }

    public function testDiff()
    {
        $this->assertEquals([1, 2, 3],
            (new ListCollection([1, 2, 3, 4, 5]))->diff(new ListCollection([4, 5, 6, 7]))->toArray());
    }

    public function testDistinct()
    {
        $this->assertEquals([2, 3, 1], (new ListCollection([2, 3, 1, 2, 2, 2, 3, 3, 3, 3]))->distinct()->toArray());

        $this->assertEquals([2, 3, 1], (new ListCollection([2, 3, 1, 2, 2, 2, 3, 3, 3, 3]))->unique()->toArray());
    }

    public function testEvery()
    {
        $this->assertEquals([3, 6, 9, 12],
            (new ListCollection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]))->every(3)->toArray());

        $this->assertEquals([3, 6, 9, 12],
            (new ListCollection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]))->withEvery(3)->toArray());

        $this->assertEquals([1, 2, 4, 5, 7, 8, 10, 11],
            (new ListCollection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]))->withoutEvery(3)->toArray());
    }

    public function testFilter()
    {
        $this->assertEquals([1, 2, 3],
            (new ListCollection([1, 4, 2, 5, 6, 7, 3, 8, 9]))->filter(function ($item) {
                return $item < 4;
            })->toArray());

        $this->assertEquals([3, 1, 2, 3, 1],
            (new ListCollection([3, 4, 5, 1, 6, 7, 2, 3, 8, 9, 1]))->filter(function ($item) {
                return $item < 4;
            })->toArray());

        $this->assertEquals([1, 2, 3],
            (new ListCollection([1, 4, 2, 5, 6, 7, 3, 8, 9]))->filterNot(function ($item) {
                return $item >= 4;
            })->toArray());

        $this->assertEquals([3, 1, 2, 3, 1],
            (new ListCollection([3, 4, 5, 1, 6, 7, 2, 3, 8, 9, 1]))->filterNot(function ($item) {
                return $item >= 4;
            })->toArray());
    }

    public function testFirst()
    {
        $this->assertInstanceOf(Some::class, (new ListCollection([1]))->firstOption());

        $this->assertInstanceOf(None::class, (new ListCollection([]))->firstOption());

        $this->assertEquals(12, (new ListCollection([12, 3, 2, 1, 1]))->first());

        $this->expectException(NoContentException::class);

        (new ListCollection([]))->first();
    }
}