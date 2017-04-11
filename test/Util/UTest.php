<?php declare(strict_types=1);

namespace PhpSlang\Util;

use PhpSlang\Collection\ListCollection;
use PHPUnit_Framework_TestCase;

class UTest extends PHPUnit_Framework_TestCase
{
    public function testDummyMap()
    {
        $this->assertEquals(new ListCollection([1, 2, 3]), (new ListCollection([1, 2, 3]))->map(U::dummyMap()));
    }
}