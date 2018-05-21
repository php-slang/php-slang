<?php

declare(strict_types=1);

namespace PhpSlang\Tuple;

use PHPUnit\Framework\TestCase;

class Tuple12Test extends TestCase
{
    public function testConstruction()
    {
        $this->assertEquals(
            ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'],
            (new Tuple12('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'))->toArray());
        $this->assertEquals(12, (new Tuple12('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'))->size());
    }

    public function testGetters()
    {
        $example = new Tuple12('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l');
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
        $this->assertEquals('k', $example->_11());
        $this->assertEquals('l', $example->_12());
    }
}
