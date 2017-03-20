<?php declare(strict_types=1);

namespace PhpSlang\Tuple;

use PHPUnit_Framework_TestCase;

class Tuple2Test extends PHPUnit_Framework_TestCase
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
}