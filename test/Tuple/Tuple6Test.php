<?php

declare(strict_types=1);

namespace PhpSlang\Tuple;

use PHPUnit_Framework_TestCase;

class Tuple6Test extends PHPUnit_Framework_TestCase
{
    public function testConstruction()
    {
        $this->assertEquals(
            ['a', 'b', 'c', 'd', 'e', 'f'],
            (new Tuple6('a', 'b', 'c', 'd', 'e', 'f'))->toArray());
        $this->assertEquals(6, (new Tuple6('a', 'b', 'c', 'd', 'e', 'f'))->size());
    }

    public function testGetters()
    {
        $example = new Tuple6('a', 'b', 'c', 'd', 'e', 'f');
        $this->assertEquals('a', $example->_1());
        $this->assertEquals('b', $example->_2());
        $this->assertEquals('c', $example->_3());
        $this->assertEquals('d', $example->_4());
        $this->assertEquals('e', $example->_5());
        $this->assertEquals('f', $example->_6());
    }
}