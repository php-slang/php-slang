<?php

declare(strict_types=1);

namespace PhpSlang\Collection;

use InvalidArgumentException;
use PhpSlang\Exception\ImproperCollectionInputException;
use PhpSlang\Exception\NoContentException;
use PhpSlang\Option\None;
use PhpSlang\Option\Some;
use PhpSlang\Util\U;
use PHPUnit\Framework\TestCase;
use stdClass;

class ListCollectionTest extends TestCase
{
    public function testConstructor()
    {
        $this->assertEquals([1, 2], (new ListCollection([1, 2]))->toArray());

        $this->expectException(ImproperCollectionInputException::class);
        (new ListCollection(['aa' => 1]));
    }

    public function testOf()
    {
        $this->assertEquals([1, 2], (ListCollection::of([1, 2]))->toArray());

        $this->expectException(ImproperCollectionInputException::class);
        ListCollection::of(['aa' => 1]);
    }

    public function testAny()
    {
        $this->assertInstanceOf(Some::class, (new ListCollection([1, 2, 3]))->any(function ($item) {
            return 2 == $item;
        }));

        $this->assertInstanceOf(None::class, (new ListCollection([1, 2, 3]))->any(function ($item) {
            return 'something' == $item;
        }));

        $this->assertEquals(2, (new ListCollection([1, 2, 3]))->any(function ($item) {
            return 2 == $item;
        })->getOrElse(100));

        $this->assertEquals(100, (new ListCollection([1, 2000, 3]))->any(function ($item) {
            return 2 == $item;
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
            return 2 == $item;
        }));
    }

    public function testDiff()
    {
        $this->assertEquals(new ListCollection([1, 2, 3, 6, 7]),
            (new ListCollection([1, 2, 3, 4, 5]))->diff(new ListCollection([4, 5, 6, 7])));

        $this->assertEquals(new ListCollection([1, 2, 3]),
            (new ListCollection([1, 2, 3, 4, 5]))->diffLeft(new ListCollection([4, 5, 6, 7])));

        $this->assertEquals(new ListCollection([6, 7]),
            (new ListCollection([1, 2, 3, 4, 5]))->diffRight(new ListCollection([4, 5, 6, 7])));
    }

    public function testDistinct()
    {
        $this->assertEquals(
            new ListCollection([2, 3, 1]),
            (new ListCollection([2, 3, 1, 2, 2, 2, 3, 3, 3, 3]))->distinct()
        );

        $this->assertEquals(
            new ListCollection([2, 3, 1]),
            (new ListCollection([2, 3, 1, 2, 2, 2, 3, 3, 3, 3]))->unique()
        );

        $obj1 = new stdClass();
        $obj1->a = 2;
        $obj2 = new stdClass();
        $obj2->a = 4;
        $this->assertEquals(
            new ListCollection([$obj1, $obj2]),
            (new ListCollection([$obj1, $obj2, $obj2, $obj2, $obj2, $obj1, $obj1]))->distinct()
        );

        $this->assertEquals(
            new ListCollection([$obj1, $obj2]),
            (new ListCollection([$obj1, $obj2, $obj2, $obj2, $obj2, $obj1, $obj1]))->unique()
        );
    }

    public function testEvery()
    {
        $this->assertEquals(new ListCollection([3, 6, 9, 12]),
            (new ListCollection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]))->every(3));

        $this->assertEquals(new ListCollection([3, 6, 9, 12]),
            (new ListCollection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]))->withEvery(3));

        $this->assertEquals(new ListCollection([1, 2, 4, 5, 7, 8, 10, 11]),
            (new ListCollection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]))->withoutEvery(3));
    }

    public function testFilter()
    {
        $this->assertEquals(new ListCollection([1, 2, 3]),
            (new ListCollection([1, 4, 2, 5, 6, 7, 3, 8, 9]))->filter(function ($item) {
                return $item < 4;
            }));

        $this->assertEquals(new ListCollection([3, 1, 2, 3, 1]),
            (new ListCollection([3, 4, 5, 1, 6, 7, 2, 3, 8, 9, 1]))->filter(function ($item) {
                return $item < 4;
            }));

        $this->assertEquals(new ListCollection([1, 2, 3]),
            (new ListCollection([1, 4, 2, 5, 6, 7, 3, 8, 9]))->filterNot(function ($item) {
                return $item >= 4;
            }));

        $this->assertEquals(new ListCollection([3, 1, 2, 3, 1]),
            (new ListCollection([3, 4, 5, 1, 6, 7, 2, 3, 8, 9, 1]))->filterNot(function ($item) {
                return $item >= 4;
            }));
    }

    public function testFirst()
    {
        $this->assertInstanceOf(Some::class, (new ListCollection([1]))->firstOption());
        $this->assertInstanceOf(None::class, (new ListCollection([]))->firstOption());
        $this->assertEquals(12, (new ListCollection([12, 3, 2, 1, 1]))->first());

        $this->expectException(NoContentException::class);
        (new ListCollection([]))->first();
    }

    public function testHead()
    {
        $this->assertInstanceOf(Some::class, (new ListCollection([1]))->headOption());
        $this->assertInstanceOf(None::class, (new ListCollection([]))->headOption());
        $this->assertEquals(12, (new ListCollection([12, 3, 2, 1, 1]))->head());

        $this->expectException(NoContentException::class);
        (new ListCollection([]))->head();
    }

    public function testFlatMap()
    {
        $this->assertEquals(new ListCollection([2, 4, 6, 8, 10, 12]),
            (new ListCollection([(new ListCollection([1, 2, 3])), (new ListCollection([4, 5, 6]))]))
                ->flatMap(function (ListCollection $nestedList) {
                    return $nestedList->map(function ($item) {
                        return $item * 2;
                    });
                })
        );
    }

    public function testFlatten()
    {
        $this->assertEquals(new ListCollection([1, 2, 3, 4, 5, 6]),
            (new ListCollection([(new ListCollection([1, 2, 3])), (new ListCollection([4, 5, 6]))]))->flatten()
        );
    }

    public function testFold()
    {
        $this->assertEquals(15,
            (new ListCollection([1, 2, 3, 4, 5]))
                ->fold(0, function ($accumulated, $current) {
                    return $accumulated + $current;
                })
        );

        $this->assertEquals(15,
            (new ListCollection([1, 2, 3, 4, 5]))
                ->reduce(0, function ($accumulated, $current) {
                    return $accumulated + $current;
                })
        );

        $this->assertEquals(1,
            (new ListCollection([1, 2, 3, 4, 5, 6]))
                ->foldLeft(720, function ($accumulated, $current) {
                    return $accumulated / $current;
                })
        );

        $this->assertEquals('123456',
            (new ListCollection(['1', '2', '3', '4', '5', '6']))
                ->foldLeft('', function ($accumulated, $current) {
                    return $accumulated.$current;
                })
        );

        $this->assertEquals('654321',
            (new ListCollection(['1', '2', '3', '4', '5', '6']))
                ->foldRight('', function ($accumulated, $current) {
                    return $accumulated.$current;
                })
        );
    }

    public function testGet()
    {
        $this->assertEquals(5, (new ListCollection([5, 3, 2]))->get(0));

        $this->assertInstanceOf(Some::class, (new ListCollection([1]))->getOption(0));

        $this->assertInstanceOf(None::class, (new ListCollection([1]))->getOption(1));

        $this->assertInstanceOf(None::class, (new ListCollection([1, 2, 3]))->getOption(-2));
    }

    public function testGetOutOfBounds()
    {
        $this->expectException(NoContentException::class);

        (new ListCollection([5, 3, 2]))->get(3);
    }

    public function testGetWithInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        (new ListCollection([5, 3, 2]))->get('asdasd');
    }

    public function testGetOptionWithInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        (new ListCollection([5, 3, 2]))->getOption('asdasd');
    }

    public function testLast()
    {
        $this->assertEquals(2, (new ListCollection([1, 3, 2]))->last());

        $this->expectException(NoContentException::class);
        (new ListCollection([]))->last();
    }

    public function testLastOption()
    {
        $this->assertInstanceOf(Some::class, (new ListCollection([1, 2, 3]))->lastOption());
        $this->assertInstanceOf(None::class, (new ListCollection([]))->lastOption());
    }

    public function testTail()
    {
        $this->assertEquals(new ListCollection([2, 3, 4]), (new ListCollection([1, 2, 3, 4]))->tail());

        $this->assertEquals(new ListCollection([]), (new ListCollection([1]))->tail());

        $this->assertEquals(new ListCollection([]), (new ListCollection([]))->tail());
    }

    public function testGroups()
    {
        $this->assertEquals(
            new ListCollection([new ListCollection([1, 2]), new ListCollection([3, 4]), new ListCollection([5, 6])]),
            (new ListCollection([1, 2, 3, 4, 5, 6]))->groups(3));
    }

    public function testGroupBy()
    {
        $this->assertEquals(
            new HashMapCollection([
                -1 => 3,
                0 => 5,
                1 => 4,
            ]),
            (new ListCollection([-2, -3, -4, 0, 0, 0, 0, 0, 1, 2, 3, 4]))
                ->partition(function ($item) {
                    return $item <=> 0;
                })
                ->map(function (ListCollection $elements) {
                    return $elements->count();
                })
        );

        $this->assertEquals(
            new HashMapCollection([
                -1 => (new ListCollection([-2, -3, -4])),
                0 => (new ListCollection([0, 0, 0, 0, 0])),
                1 => (new ListCollection([1, 2, 3, 4])),
            ]),
            (new ListCollection([-2, -3, -4, 0, 0, 0, 0, 0, 1, 2, 3, 4]))
                ->groupBy(function ($item) {
                    return $item <=> 0;
                })
        );
    }

    public function testGroupByWithPredefinedGroups()
    {
        $this->assertEquals(
            new HashMapCollection([0 => new ListCollection([0]), 1 => new ListCollection([])]),
            (new ListCollection([0]))
                ->partition(function ($item) {
                    return $item;
                }, new SetCollection([0, 1]))
        );
    }

    public function testChunks()
    {
        $this->assertEquals(new ListCollection([new ListCollection([1, 2, 3]), new ListCollection([4, 5, 6])]),
            (new ListCollection([1, 2, 3, 4, 5, 6]))->chunks(3));
    }

    public function testHas()
    {
        $this->assertTrue((new ListCollection([1, 2, 3, 4]))->has(function ($item) {
            return $item >= 4;
        }));
        $this->assertTrue((new ListCollection([1, 2, 3, 4]))->hasNot(function ($item) {
            return $item >= 44;
        }));
        $this->assertFalse((new ListCollection([1, 2, 3, 4]))->has(function ($item) {
            return $item >= 44;
        }));
        $this->assertFalse((new ListCollection([1, 2, 3, 4]))->hasNot(function ($item) {
            return $item >= 4;
        }));

        $this->assertTrue((new ListCollection([1, 2, 3, 4]))->hasValue(4));
        $this->assertTrue((new ListCollection([1, 2, 3, 4]))->hasNotValue(44));
        $this->assertFalse((new ListCollection([1, 2, 3, 4]))->hasValue(44));
        $this->assertFalse((new ListCollection([1, 2, 3, 4]))->hasNotValue(4));
    }

    public function testIndexOf()
    {
        $this->assertEquals(2, (new ListCollection([1, 2, 3, 4]))->indexOf(function ($item) {
            return 3 == $item;
        }));

        $this->assertEquals(-1, (new ListCollection([1, 2, 3, 4]))->indexOf(function ($item) {
            return 30 == $item;
        }));
    }

    public function testIntersection()
    {
        $this->assertEquals(new ListCollection([4, 5, 6]),
            (new ListCollection([1, 2, 3, 4, 5, 6, 7]))
                ->intersection(new ListCollection([0, 4, 5, 6, 8, 9])));

        $this->assertEquals(new ListCollection([]),
            (new ListCollection([1, 2, 3]))
                ->intersection(new ListCollection([0, 4, 5, 6, 8, 9])));
    }

    public function testIsEmpty()
    {
        $this->assertTrue((new ListCollection([]))->isEmpty());

        $this->assertFalse((new ListCollection([]))->isNotEmpty());

        $this->assertNotTrue((new ListCollection([1, 2]))->isEmpty());

        $this->assertNotFalse((new ListCollection([1, 2]))->isNotEmpty());
    }

    public function testMap()
    {
        $this->assertEquals(new ListCollection([2, 4, 6]),
            (new ListCollection([1, 2, 3]))
                ->map(function ($item) {
                    return $item * 2;
                })
        );
    }

    public function testMax()
    {
        $this->assertInstanceOf(Some::class, (new ListCollection([1, 10, 7]))->max());
        $this->assertEquals(10, (new ListCollection([1, 10, 7]))->max()->getOrElse(0));

        $this->assertInstanceOf(None::class, (new ListCollection([]))->max());
        $this->assertEquals(0, (new ListCollection([]))->max()->getOrElse(0));

        $obj1 = new stdClass();
        $obj1->aa = 3;
        $obj2 = new stdClass();
        $obj2->aa = 6;
        $this->assertEquals($obj2, (new ListCollection([$obj1, $obj2]))->max(function (stdClass $item) {
            return $item->aa;
        })->getOrElse($obj1));
    }

    public function testMin()
    {
        $this->assertInstanceOf(Some::class, (new ListCollection([1, 10, 7]))->min());
        $this->assertEquals(1, (new ListCollection([1, 10, 7]))->min()->getOrElse(0));

        $this->assertInstanceOf(None::class, (new ListCollection([]))->min());
        $this->assertEquals(0, (new ListCollection([]))->min()->getOrElse(0));

        $obj1 = new stdClass();
        $obj1->aa = 3;
        $obj2 = new stdClass();
        $obj2->aa = 6;
        $this->assertEquals($obj1, (new ListCollection([$obj1, $obj2]))->min(function (stdClass $item) {
            return $item->aa;
        })->getOrElse($obj2));
    }

    public function testMerge()
    {
        $this->assertEquals(new ListCollection([1, 2, 3, 4, 5]),
            (new ListCollection([1, 2]))->merge(new ListCollection([3, 4, 5])));
    }

    public function testReversed()
    {
        $this->assertEquals(new ListCollection([5, 4, 3, 2, 1]), (new ListCollection([1, 2, 3, 4, 5]))->reversed());
    }

    public function testSize()
    {
        $this->assertEquals(0, (new ListCollection([]))->size());
        $this->assertEquals(1, (new ListCollection([6]))->size());
        $this->assertEquals(10, (new ListCollection([0, 9, 8, 7, 5, 4, 3, 2, 2, 2]))->size());
    }

    public function testSlice()
    {
        $exampleList = new ListCollection([1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 1, 2, 3, 5, 4, 3, 2]);

        $this->assertEquals(new ListCollection([4, 5, 6, 7, 8]), $exampleList->slice(3, 5));

        $this->assertEquals(new ListCollection([4, 3, 2]), $exampleList->slice(-3, 5));

        $this->assertEquals(new ListCollection([0, 1, 2, 3, 5]), $exampleList->slice(-8, 5));

        $this->assertEquals(new ListCollection([4, 5]), $exampleList->slice(3, -12));
    }

    public function testSort()
    {
        $this->assertEquals(new ListCollection([1, 2, 3, 4, 5]), (new ListCollection([1, 5, 2, 4, 3]))->sort());

        $obj1 = new stdClass();
        $obj1->aa = 3;
        $obj2 = new stdClass();
        $obj2->aa = 6;
        $this->assertEquals(new ListCollection([$obj1, $obj2]),
            (new ListCollection([$obj2, $obj1]))
                ->sort(function ($left, $right) {
                    return $left->aa > $right->aa;
                })
        );
    }

    public function testSortBy()
    {
        $this->assertEquals(
            new ListCollection([1, 2, 3, 4, 5]),
            (new ListCollection([1, 5, 2, 4, 3]))->sortBy(U::dummyMap())
        );

        $obj1 = new stdClass();
        $obj1->aa = 3;
        $obj2 = new stdClass();
        $obj2->aa = 6;
        $this->assertEquals(
            new ListCollection([$obj1, $obj2]),
            (new ListCollection([$obj2, $obj1]))->sortBy(function (stdClass $item) {
                return $item->aa;
            })
        );

        $this->assertNotEquals(
            new ListCollection([$obj2, $obj1]),
            (new ListCollection([$obj2, $obj1]))->sortBy(function (stdClass $item) {
                return $item->aa;
            })
        );
    }

    public function testSum()
    {
        $this->assertEquals(new None(), (new ListCollection([]))->sum());
        $this->assertEquals(new Some(0), (new ListCollection([-1, -1, 0, 2]))->sum());
        $this->assertEquals(new Some(6), (new ListCollection([-1, -1, 0, 2, 1, 2, 3]))->sum());
    }

    public function testToList()
    {
        $this->assertEquals(
            new ListCollection([1, 2, 3, 3]),
            (new ListCollection([1, 2, 3, 3]))->toList()
        );
    }

    public function testToHashMap()
    {
        $this->assertEquals(
            new HashMapCollection([0 => 1, 1 => 2, 2 => 3, 3 => 3]),
            (new ListCollection([1, 2, 3, 3]))->toHashMap()
        );
    }
}
