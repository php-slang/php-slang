<?php

declare(strict_types=1);

namespace PhpSlang\Tuple;

use PHPUnit\Framework\TestCase;

class Tuple8Test extends TestCase
{
    public function testConstruction()
    {
        $this->assertEquals(
            ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'],
            (new Tuple8('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'))->toArray());
        $this->assertEquals(8, (new Tuple8('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'))->size());
    }

    public function testGetters()
    {
        $example = new Tuple8('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h');
        $this->assertEquals('a', $example->_1());
        $this->assertEquals('b', $example->_2());
        $this->assertEquals('c', $example->_3());
        $this->assertEquals('d', $example->_4());
        $this->assertEquals('e', $example->_5());
        $this->assertEquals('f', $example->_6());
        $this->assertEquals('g', $example->_7());
        $this->assertEquals('h', $example->_8());
    }
}
