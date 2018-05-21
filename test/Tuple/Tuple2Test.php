<?php

declare(strict_types=1);

namespace PhpSlang\Tuple;

use PhpSlang\Collection\HashMapCollection;
use PhpSlang\Collection\ListCollection;
use PhpSlang\Collection\SetCollection;
use PHPUnit\Framework\TestCase;

class Tuple2Test extends TestCase
{
    public function testConstruction()
    {
        $this->assertEquals(
            ['a', 'b'],
            (new Tuple2('a', 'b'))->toArray());
        $this->assertEquals(2, (new Tuple2('a', 'b'))->size());
    }

    public function testGetters()
    {
        $example = new Tuple2('a', 'b');
        $this->assertEquals('a', $example->_1());
        $this->assertEquals('b', $example->_2());
    }

    public function testToList()
    {
        $this->assertEquals(
            new ListCollection([1, 2]),
            (new Tuple2(1, 2))->toList()
        );
    }

    public function testHashMap()
    {
        $this->assertEquals(
            new HashMapCollection([0 => 1, 1 => 2]),
            (new Tuple2(1, 2))->toHashMap()
        );
    }

    public function testSet()
    {
        $this->assertEquals(
            new SetCollection([1]),
            (new Tuple2(1, 1))->toSet()
        );
    }
}
