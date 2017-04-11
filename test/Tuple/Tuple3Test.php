<?php

declare(strict_types=1);

namespace PhpSlang\Tuple;

use PHPUnit_Framework_TestCase;

class Tuple3Test extends PHPUnit_Framework_TestCase
{
    public function testConstruction()
    {
        $this->assertEquals(
            ['a', 'b', 'c'],
            (new Tuple3('a', 'b', 'c'))->toArray());
        $this->assertEquals(3, (new Tuple3('a', 'b', 'c'))->size());
    }

    public function testGetters()
    {
        $example = new Tuple3('a', 'b', 'c');
        $this->assertEquals('a', $example->_1());
        $this->assertEquals('b', $example->_2());
        $this->assertEquals('c', $example->_3());
    }
}