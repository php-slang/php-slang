<?php

declare(strict_types=1);

namespace PhpSlang\Match;

use PhpSlang\Exception\NoMatchFoundException;
use PhpSlang\Option\Option;
use PhpSlang\Option\Some;
use PhpSlang\Util\U;
use PHPUnit\Framework\TestCase;

class MatchTest extends TestCase
{
    public function testMatchEquals()
    {
        $this->assertEquals(2, Match::val(1)->of(
            When::equals(1, 2)
        ));

        $this->assertEquals(2, Match::val(1)->of(
            When::equals(1, function ($item) {
                return $item * 2;
            })
        ));

        $this->expectException(NoMatchFoundException::class);
        Match::val(5)->of(
            When::equals(1, 2)
        );
    }

    public function testMatchOther()
    {
        $this->assertEquals(2, Match::val(1)->of(
            When::other(2)
        ));

        $this->assertEquals(2, Match::val(1)->of(
            When::other(function ($item) {
                return $item * 2;
            })
        ));
    }

    public function testMatchResults()
    {
        $this->assertEquals(2, Match::val(1)->of(
            When::results(function ($item) {
                return $item == 1;
            }, 2)
        ));

        $this->assertEquals(2, Match::val(1)->of(
            When::results(function ($item) {
                return $item == 1;
            }, function ($item) {
                return $item * 2;
            })
        ));

        $this->expectException(NoMatchFoundException::class);
        Match::val(5)->of(
            When::results(function ($item) {
                return $item == 1;
            }, 2)
        );
    }

    public function testMatchTypeOf()
    {
        $this->assertEquals(2, Match::val(new Some(1))->of(
            When::typeOf(Option::class, 2)
        ));

        $this->assertEquals(2, Match::val(new Some(1))->of(
            When::typeOf(Option::class, function (Option $item) {
                return $item->get() * 2;
            })
        ));

        $this->expectException(NoMatchFoundException::class);
        Match::val(5)->of(
            When::typeOf(Option::class, function (Option $item) {
                return $item->get() * 2;
            })
        );
    }

    public function testMatchWithManyCases()
    {
        $this->assertEquals(1, Match::val("test")->of(
            When::typeOf(Option::class, function (Option $item) {
                return $item->get() * 2;
            }),
            When::equals("test", 1),
            When::other(11)
        ));

        $this->assertEquals(1, Match::val("test")->of(
            When::typeOf(Option::class, function (Option $item) {
                return $item->get() * 2;
            }),
            When::results(function ($item) {
                return $item == "test";
            }, 1),
            When::equals("test", 10),
            When::other(11)
        ));

        $this->assertEquals(11, Match::val("test 123")->of(
            When::typeOf(Option::class, function (Option $item) {
                return $item->get() * 2;
            }),
            When::results(function ($item) {
                return $item == "test";
            }, 1),
            When::equals("test", 10),
            When::other(11)
        ));

        $this->assertEquals(3, Match::val("test3")->of(
            When::equals("test1", 1),
            When::equals("test2", 2),
            When::equals("test3", 3),
            When::equals("test4", 4),
            When::equals("test5", 5)
        ));

        $this->assertEquals("test5", Match::val("test5")->of(
            When::equals("test1", U::dummyMap()),
            When::equals("test2", U::dummyMap()),
            When::equals("test3", U::dummyMap()),
            When::equals("test4", U::dummyMap()),
            When::equals("test5", U::dummyMap())
        ));
    }
}
