<?php

declare(strict_types=1);

namespace PhpSlang\Util;

use PhpSlang\Collection\ListCollection;
use PHPUnit\Framework\TestCase;

class UTest extends TestCase
{
    public function testDummyMap()
    {
        $this->assertEquals(new ListCollection([1, 2, 3]), (new ListCollection([1, 2, 3]))->map(U::dummyMap()));
    }
}
