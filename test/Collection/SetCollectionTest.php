<?php declare(strict_types = 1);

namespace PhpSlang\Collection;

use PhpSlang\Exception\ImproperCollectionInputException;
use PhpSlang\Exception\NoContentException;
use PhpSlang\Option\None;
use PhpSlang\Option\Some;
use PhpSlang\Util\U;
use PHPUnit_Framework_TestCase;
use stdClass;

class SetCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $this->assertEquals([1, 2], (new SetCollection([1, 2]))->toArray());

        $this->assertEquals([1, 2], (new SetCollection([1, 2, 2, 2, 2, 2]))->toArray());

        $this->expectException(ImproperCollectionInputException::class);
        (new SetCollection(['aa' => 1]));
    }

    public function testOf()
    {
        $this->assertEquals([1, 2], (SetCollection::of([1, 2, 2, 2, 2]))->toArray());

        $this->expectException(ImproperCollectionInputException::class);
        SetCollection::of(['aa' => 1]);
    }

    public function testAny()
    {
        $this->assertInstanceOf(Some::class, (new SetCollection([1, 2, 2, 2, 2, 3]))->any(function ($item) {
            return $item == 2;
        }));

        $this->assertInstanceOf(None::class, (new SetCollection([1, 2, 2, 2, 2, 3]))->any(function ($item) {
            return $item == "something";
        }));

        $this->assertEquals(2, (new SetCollection([1, 2, 2, 2, 2, 2, 3]))->any(function ($item) {
            return $item == 2;
        })->getOrElse(100));

        $this->assertEquals(100, (new SetCollection([1, 1, 1, 1, 2000, 3]))->any(function ($item) {
            return $item == 2;
        })->getOrElse(100));
    }

    public function testAvg()
    {
        $this->assertEquals(3, (new SetCollection([1, 2, 2, 2, 2, 2, 2, 2, 3, 4, 5]))->avg()->getOrElse(100));

        $this->assertEquals(100, (new SetCollection([]))->avg()->getOrElse(100));
    }

    public function testCount()
    {
        $this->assertEquals(3, (new SetCollection([1, 2, 2, 2, 2, 2, 2, 3]))->count());

        $this->assertEquals(1, (new SetCollection([1, 2, 2, 2, 2, 2, 3]))->count(function ($item) {
            return $item == 2;
        }));
    }

    public function testDiff()
    {
        $this->assertEquals(
            new SetCollection([1, 2, 3, 6, 7]),
            (new SetCollection([1, 2, 3, 4, 5]))->diff(new SetCollection([4, 5, 6, 7]))
        );

        $this->assertEquals(
            new SetCollection([1, 2, 3]),
            (new SetCollection([1, 2, 3, 4, 5]))->diffLeft(new SetCollection([4, 5, 6, 7]))
        );

        $this->assertEquals(
            new SetCollection([6, 7]),
            (new SetCollection([1, 2, 3, 4, 5]))->diffRight(new SetCollection([4, 5, 6, 7]))
        );
    }

    public function testDistinct()
    {
        $this->assertEquals(
            new SetCollection([2, 3, 1]),
            (new SetCollection([2, 3, 1, 2, 2, 2, 3, 3, 3, 3]))->distinct()
        );

        $this->assertEquals(
            new SetCollection([2, 3, 1]),
            (new SetCollection([2, 3, 1, 2, 2, 2, 3, 3, 3, 3]))->unique()
        );
    }

    public function testEvery()
    {
        $this->assertEquals(
            new SetCollection([3, 6, 9, 12]),
            (new SetCollection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]))->every(3)
        );

        $this->assertEquals(
            new SetCollection([3, 6, 9, 12]),
            (new SetCollection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]))->withEvery(3)
        );

        $this->assertEquals(
            new SetCollection([1, 2, 4, 5, 7, 8, 10, 11]),
            (new SetCollection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]))->withoutEvery(3)
        );
    }

    public function testFilter()
    {
        $this->assertEquals(
            new SetCollection([1, 2, 3]),
            (new SetCollection([1, 4, 2, 5, 6, 7, 3, 8, 9]))->filter(function ($item) {
                return $item < 4;
            })
        );

        $this->assertEquals(
            new SetCollection([3, 1, 2, 3, 1]),
            (new SetCollection([3, 4, 5, 1, 6, 7, 2, 3, 8, 9, 1]))->filter(function ($item) {
                return $item < 4;
            })
        );

        $this->assertEquals(
            new SetCollection([1, 2, 3]),
            (new SetCollection([1, 4, 2, 5, 6, 7, 3, 8, 9]))->filterNot(function ($item) {
                return $item >= 4;
            })
        );

        $this->assertEquals(
            new SetCollection([3, 1, 2, 3, 1]),
            (new SetCollection([3, 4, 5, 1, 6, 7, 2, 3, 8, 9, 1]))->filterNot(function ($item) {
                return $item >= 4;
            })
        );
    }

    public function testFirst()
    {
        $this->assertInstanceOf(Some::class, (new SetCollection([1]))->firstOption());
        $this->assertInstanceOf(None::class, (new SetCollection([]))->firstOption());
        $this->assertEquals(12, (new SetCollection([12, 3, 2, 1, 1]))->first());

        $this->expectException(NoContentException::class);
        (new SetCollection([]))->first();
    }

    public function testHead()
    {
        $this->assertInstanceOf(Some::class, (new SetCollection([1]))->headOption());
        $this->assertInstanceOf(None::class, (new SetCollection([]))->headOption());
        $this->assertEquals(12, (new SetCollection([12, 3, 2, 1, 1]))->head());

        $this->expectException(NoContentException::class);
        (new SetCollection([]))->head();
    }

    public function testFlatMap()
    {
        $this->assertEquals(new SetCollection([2, 4, 6, 8, 10, 12]),
            (new SetCollection([(new SetCollection([1, 2, 3])), (new SetCollection([4, 5, 6]))]))
                ->flatMap(function (SetCollection $nestedList) {
                    return $nestedList->map(function ($item) {
                        return $item * 2;
                    });
                })

        );
    }

    public function testFlatten()
    {
        $this->assertEquals(new SetCollection([1, 2, 3, 4, 5, 6]),
            (new SetCollection([(new SetCollection([1, 2, 3])), (new SetCollection([4, 5, 6]))]))->flatten()
        );
    }

    public function testFold()
    {
        $this->assertEquals(15,
            (new SetCollection([1, 2, 3, 4, 5]))
                ->fold(0, function ($accumulated, $current) {
                    return $accumulated + $current;
                })
        );

        $this->assertEquals(1,
            (new SetCollection([1, 2, 3, 4, 5, 6]))
                ->foldLeft(720, function ($accumulated, $current) {
                    return $accumulated / $current;
                })
        );

        $this->assertEquals("123456",
            (new SetCollection(["1", "2", "3", "4", "5", "6"]))
                ->foldLeft("", function ($accumulated, $current) {
                    return $accumulated . $current;
                })
        );

        $this->assertEquals("654321",
            (new SetCollection(["1", "2", "3", "4", "5", "6"]))
                ->foldRight("", function ($accumulated, $current) {
                    return $accumulated . $current;
                })
        );
    }

    public function testGet()
    {
        $this->assertEquals(5, (new SetCollection([5, 3, 2]))->get(0));

        $this->assertInstanceOf(Some::class, (new SetCollection([1]))->getOption(0));

        $this->assertInstanceOf(None::class, (new SetCollection([1]))->getOption(1));

        $this->assertInstanceOf(None::class, (new SetCollection([1, 2, 3]))->getOption(-2));

        $this->expectException(NoContentException::class);

        $this->assertEquals(5, (new SetCollection([5, 3, 2]))->get(3));
    }

    public function testTail()
    {
        $this->assertEquals(new SetCollection([2, 3, 4]), (new SetCollection([1, 2, 3, 4]))->tail());

        $this->assertEquals(new SetCollection([]), (new SetCollection([1]))->tail());

        $this->assertEquals(new SetCollection([]), (new SetCollection([]))->tail());
    }

    public function testGroups()
    {
        $this->assertEquals(
            new SetCollection([new SetCollection([1, 2]), new SetCollection([3, 4]), new SetCollection([5, 6])]),
            (new SetCollection([1, 2, 3, 4, 5, 6]))->groups(3));
    }

    public function testGroupBy()
    {
        $this->assertEquals(
            new HashMapCollection([
                -1 => 3,
                0 => 1,
                1 => 4
            ]),
            (new SetCollection([-2, -3, -4, 0, 0, 0, 0, 0, 1, 2, 3, 4]))
                ->partition(function ($item) {
                    return $item <=> 0;
                })
                ->map(function (SetCollection $elements) {
                    return $elements->count();
                })
        );

        $this->assertEquals(
            new HashMapCollection([
                -1 => (new SetCollection([-2, -3, -4])),
                0 => (new SetCollection([0, 0, 0, 0, 0])),
                1 => (new SetCollection([1, 2, 3, 4]))
            ]),
            (new SetCollection([-2, -3, -4, 0, 0, 0, 0, 0, 1, 2, 3, 4]))
                ->groupBy(function ($item) {
                    return $item <=> 0;
                })
        );
    }

    public function testChunks()
    {
        $this->assertEquals(new SetCollection([new SetCollection([1, 2, 3]), new SetCollection([4, 5, 6])]),
            (new SetCollection([1, 2, 3, 4, 5, 6]))->chunks(3));
    }

    public function testHas()
    {
        $this->assertTrue((new SetCollection([1, 2, 3, 4]))->has(function ($item) {
            return $item >= 4;
        }));
        $this->assertTrue((new SetCollection([1, 2, 3, 4]))->hasNot(function ($item) {
            return $item >= 44;
        }));
        $this->assertFalse((new SetCollection([1, 2, 3, 4]))->has(function ($item) {
            return $item >= 44;
        }));
        $this->assertFalse((new SetCollection([1, 2, 3, 4]))->hasNot(function ($item) {
            return $item >= 4;
        }));

        $this->assertTrue((new SetCollection([1, 2, 3, 4]))->hasValue(4));
        $this->assertTrue((new SetCollection([1, 2, 3, 4]))->hasNotValue(44));
        $this->assertFalse((new SetCollection([1, 2, 3, 4]))->hasValue(44));
        $this->assertFalse((new SetCollection([1, 2, 3, 4]))->hasNotValue(4));
    }

    public function testIndexOf()
    {
        $this->assertEquals(2, (new SetCollection([1, 2, 3, 4]))->indexOf(function ($item) {
            return $item == 3;
        }));

        $this->assertEquals(-1, (new SetCollection([1, 2, 3, 4]))->indexOf(function ($item) {
            return $item == 30;
        }));
    }

    public function testIntersection()
    {
        $this->assertEquals(
            new SetCollection([4, 5, 6]),
            (new SetCollection([1, 2, 2, 2, 2, 3, 4, 5, 6, 7]))->intersection(new SetCollection([0, 4, 5, 6, 8, 9]))
        );

        $this->assertEquals(
            new SetCollection([]),
            (new SetCollection([1, 2, 3]))->intersection(new SetCollection([0, 4, 4, 4, 4, 4, 5, 5, 5, 5, 6, 8, 9]))
        );
    }

    public function testIsEmpty()
    {
        $this->assertTrue((new SetCollection([]))->isEmpty());

        $this->assertFalse((new SetCollection([]))->isNotEmpty());

        $this->assertNotTrue((new SetCollection([1, 2]))->isEmpty());

        $this->assertNotFalse((new SetCollection([1, 2]))->isNotEmpty());
    }

    public function testMap()
    {
        $this->assertEquals(new SetCollection([2, 4, 6]),
            (new SetCollection([1, 2, 3]))
                ->map(function ($item) {
                    return $item * 2;
                })
        );
    }

    public function testMax()
    {
        $this->assertInstanceOf(Some::class, (new SetCollection([1, 10, 7]))->max());
        $this->assertEquals(10, (new SetCollection([1, 10, 7]))->max()->getOrElse(0));

        $this->assertInstanceOf(None::class, (new SetCollection([]))->max());
        $this->assertEquals(0, (new SetCollection([]))->max()->getOrElse(0));

        $obj1 = new stdClass();
        $obj1->a = 3;
        $obj2 = new stdClass();
        $obj2->a = 6;
        $this->assertEquals(
            $obj2,
            (new SetCollection([$obj1, $obj2]))
                ->max(function (stdClass $item) {
                    return $item->a;
                })
                ->getOrElse($obj1)
        );
    }

    public function testMin()
    {
        $this->assertInstanceOf(Some::class, (new SetCollection([1, 10, 7]))->min());
        $this->assertEquals(1, (new SetCollection([1, 10, 7]))->min()->getOrElse(0));

        $this->assertInstanceOf(None::class, (new SetCollection([]))->min());
        $this->assertEquals(0, (new SetCollection([]))->min()->getOrElse(0));

        $obj1 = new stdClass();
        $obj1->aa = 3;
        $obj2 = new stdClass();
        $obj2->aa = 6;
        $this->assertEquals(
            $obj1,
            (new SetCollection([$obj1, $obj2, $obj2, $obj2, $obj1]))
                ->min(function (stdClass $item) {
                    return $item->aa;
                })
                ->getOrElse($obj2)
        );
    }

    public function testMerge()
    {
        $this->assertEquals(new SetCollection([1, 2, 3, 4, 5]),
            (new SetCollection([1, 2]))->merge(new SetCollection([3, 4, 5])));
    }

    public function testReversed()
    {
        $this->assertEquals(new SetCollection([5, 4, 3, 2, 1]), (new SetCollection([1, 2, 3, 4, 5]))->reversed());
    }

    public function testSize()
    {
        $this->assertEquals(0, (new SetCollection([]))->size());
        $this->assertEquals(1, (new SetCollection([6]))->size());
        $this->assertEquals(8, (new SetCollection([0, 9, 8, 7, 5, 4, 3, 2, 2, 2, 2, 2, 2]))->size());
    }

    public function testSlice()
    {
        $exampleList = new SetCollection([1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 1, 2, 3, 5, 4, 3, 2]);

        $this->assertEquals(new SetCollection([4, 5, 6, 7, 8]), $exampleList->slice(3, 5));

        $this->assertEquals(new SetCollection([8, 9, 0]), $exampleList->slice(-3, 5));

        $this->assertEquals(new SetCollection([3, 4, 5, 6, 7]), $exampleList->slice(-8, 5));

        $this->assertEquals(new SetCollection([4, 5, 6, 7, 8]), $exampleList->slice(3, -2));
    }

    public function testSort()
    {
        $this->assertEquals(new SetCollection([1, 2, 3, 4, 5]), (new SetCollection([1, 5, 2, 4, 3]))->sort());

        $obj1 = new stdClass();
        $obj1->aa = 3;
        $obj2 = new stdClass();
        $obj2->aa = 6;
        $this->assertEquals(new SetCollection([$obj1, $obj2]),
            (new SetCollection([$obj2, $obj1]))
                ->sort(function ($left, $right) {
                    return $left->aa > $right->aa;
                })
        );
    }

    public function testSortBy()
    {
        $this->assertEquals(
            new SetCollection([1, 2, 3, 4, 5]),
            (new SetCollection([1, 5, 2, 4, 3]))->sortBy(U::dummyMap())
        );

        $obj1 = new stdClass();
        $obj1->aa = 3;
        $obj2 = new stdClass();
        $obj2->aa = 6;
        $this->assertEquals(
            new SetCollection([$obj1, $obj2]),
            (new SetCollection([$obj2, $obj1]))->sortBy(function (stdClass $item) {
                return $item->aa;
            })
        );

        $this->assertNotEquals(
            new SetCollection([$obj2, $obj1]),
            (new SetCollection([$obj2, $obj1]))->sortBy(function (stdClass $item) {
                return $item->aa;
            })
        );
    }

    public function testSum()
    {
        $this->assertEquals(new None(), (new SetCollection([]))->sum());
        $this->assertEquals(new Some(1), (new SetCollection([-1, -1, 0, 2]))->sum());
        $this->assertEquals(new Some(5), (new SetCollection([-1, -1, 0, 2, 1, 2, 3]))->sum());
    }
}
