<?php declare(strict_types=1);

namespace PhpSlang\Match;

use PhpSlang\Collection\ListCollection;
use PhpSlang\Either\Either;
use PhpSlang\Match\When\Equals;
use PhpSlang\Match\When\Other;
use PhpSlang\Match\When\Results;
use PhpSlang\Match\When\TypeOf;
use PhpSlang\Option\None;
use PhpSlang\Option\Option;
use PhpSlang\Util\U;
use PHPUnit_Framework_TestCase;

class WhenTest extends PHPUnit_Framework_TestCase
{
    public function testWhenOf()
    {
        $this->assertInstanceOf(Equals::class, When::equals(1, 2));
        $this->assertInstanceOf(TypeOf::class, When::typeOf(Match::class, 2));
        $this->assertInstanceOf(Results::class, When::results(U::dummyMap(), 2));
        $this->assertInstanceOf(Other::class, When::other(U::dummyMap()));
    }

    public function testGetResults()
    {
        $this->assertEquals(2, (new When(1, 2))->getResult(1));

        $this->assertEquals(20, (new When(1, function ($item) {
            return $item * 2;
        }))->getResult(10));
    }

    public function testMatchForEquals()
    {
        $this->assertTrue((new Equals(1, 2))->matches(1));
        $this->assertFalse((new Equals(1, 2))->matches(2));

        $this->assertTrue((new Equals(1, U::dummyMap()))->matches(1));
        $this->assertFalse((new Equals(1, U::dummyMap()))->matches(2));
    }

    public function testMatchForResults()
    {
        $this->assertTrue((new Results(function ($item) {
            return $item == 3;
        }, 2))->matches(3));

        $this->assertFalse((new Results(function ($item) {
            return $item == 3;
        }, 2))->matches(5));

        $this->assertTrue((new Results(function ($item) {
            return $item == 3;
        }, U::dummyMap()))->matches(3));

        $this->assertFalse((new Results(function ($item) {
            return $item == 3;
        }, U::dummyMap()))->matches(5));
    }

    public function testMatchForTypeOf()
    {
        $this->assertTrue((new TypeOf(Option::class, 2))->matches(new None()));
        $this->assertFalse((new Equals(Option::class, 2))->matches(Either::class));

        $this->assertTrue((new TypeOf(Option::class, U::dummyMap()))->matches(new None()));
        $this->assertFalse((new Equals(Option::class, U::dummyMap()))->matches(Either::class));
    }

    public function testMatchForOther()
    {
        $this->assertTrue((new Other(2))->matches(new None()));
        $this->assertNotFalse((new Other(34))->matches(24));

        $this->assertTrue((new Other(U::dummyMap()))->matches(new None()));
        $this->assertNotFalse((new Other(U::dummyMap()))->matches(24));
    }

    public function testMatchWhenUnspecifiedByValue()
    {
        $this->assertEquals(
            1,
            Match::val("aaa")->of(
                (new When("aaa132", 3)),
                (new When("aaa", 1))
            )
        );
    }

    public function testMatchWhenUnspecifiedByExpression()
    {
        $this->assertEquals(
            1,
            Match::val("aaa")->of(
                (new When("aaa132", 3)),
                (new When(function (string $val) {
                    return $val == "aaa";
                }, 1))
            )
        );
    }

    public function testMatchWhenUnspecifiedByType()
    {
        $this->assertEquals(
            1,
            Match::val(new ListCollection([1, 2, 3]))->of(
                (new When("aaa132", 3)),
                (new When(ListCollection::class, 1))
            )
        );
    }
}
