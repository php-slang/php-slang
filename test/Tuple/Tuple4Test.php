<?php declare(strict_types=1);

namespace PhpSlang\Tuple;

use PHPUnit_Framework_TestCase;

class Tuple4Test extends PHPUnit_Framework_TestCase
{
    public function testConstruction()
    {
        $this->assertEquals(
            ['a', 'b', 'c', 'd'],
            (new Tuple4('a', 'b', 'c', 'd'))->toArray());
        $this->assertEquals(4, (new Tuple4('a', 'b', 'c', 'd'))->size());
    }

    public function testGetters()
    {
        $example = new Tuple4('a', 'b', 'c', 'd');
        $this->assertEquals('a', $example->_1());
        $this->assertEquals('b', $example->_2());
        $this->assertEquals('c', $example->_3());
        $this->assertEquals('d', $example->_4());
    }
}