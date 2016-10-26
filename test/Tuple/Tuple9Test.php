<?php

namespace PhpSlang\Tuple;

use PHPUnit_Framework_TestCase;

class Tuple9Test extends PHPUnit_Framework_TestCase
{
    public function testConstruction()
    {
        $this->assertEquals(
            ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i'],
            (new Tuple9('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i'))->toArray());
        $this->assertEquals(9, (new Tuple9('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i'))->size());
    }

    public function testGetters()
    {
        $example = new Tuple9('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i');
        $this->assertEquals('a', $example->_1());
        $this->assertEquals('b', $example->_2());
        $this->assertEquals('c', $example->_3());
        $this->assertEquals('d', $example->_4());
        $this->assertEquals('e', $example->_5());
        $this->assertEquals('f', $example->_6());
        $this->assertEquals('g', $example->_7());
        $this->assertEquals('h', $example->_8());
        $this->assertEquals('i', $example->_9());
    }
}