<?php declare(strict_types=1);

namespace PhpSlang\Tuple;

use PHPUnit_Framework_TestCase;

class Tuple7Test extends PHPUnit_Framework_TestCase
{
    public function testConstruction()
    {
        $this->assertEquals(
            ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
            (new Tuple7('a', 'b', 'c', 'd', 'e', 'f', 'g'))->toArray());
        $this->assertEquals(7, (new Tuple7('a', 'b', 'c', 'd', 'e', 'f', 'g'))->size());
    }

    public function testGetters()
    {
        $example = new Tuple7('a', 'b', 'c', 'd', 'e', 'f', 'g');
        $this->assertEquals('a', $example->_1());
        $this->assertEquals('b', $example->_2());
        $this->assertEquals('c', $example->_3());
        $this->assertEquals('d', $example->_4());
        $this->assertEquals('e', $example->_5());
        $this->assertEquals('f', $example->_6());
        $this->assertEquals('g', $example->_7());
    }
}