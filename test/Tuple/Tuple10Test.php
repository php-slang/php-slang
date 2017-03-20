<?php declare(strict_types=1);

namespace PhpSlang\Tuple;

use PHPUnit_Framework_TestCase;

class Tuple10Test extends PHPUnit_Framework_TestCase
{
    public function testConstruction()
    {
        $this->assertEquals(
            ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'],
            (new Tuple10('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'))->toArray());
        $this->assertEquals(10, (new Tuple10('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'))->size());
    }

    public function testGetters()
    {
        $example = new Tuple10('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j');
        $this->assertEquals('a', $example->_1());
        $this->assertEquals('b', $example->_2());
        $this->assertEquals('c', $example->_3());
        $this->assertEquals('d', $example->_4());
        $this->assertEquals('e', $example->_5());
        $this->assertEquals('f', $example->_6());
        $this->assertEquals('g', $example->_7());
        $this->assertEquals('h', $example->_8());
        $this->assertEquals('i', $example->_9());
        $this->assertEquals('j', $example->_10());
    }
}