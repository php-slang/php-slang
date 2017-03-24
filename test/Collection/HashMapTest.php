<?php declare(strict_types=1);

namespace PhpSlang\Collection;

use PHPUnit_Framework_TestCase;

class HashMapTest extends PHPUnit_Framework_TestCase
{
    public function testToList()
    {
        $this->assertEquals(
            new ListCollection([1, 2, 3]),
            (new HashMapCollection(["a" => 1, "b" => 2, "c" => 3]))->toList()
        );
    }

    public function testToSet()
    {
        $this->assertEquals(
            new SetCollection([1, 2, 3]),
            (new HashMapCollection(["a" => 1, "b" => 2, "c" => 1, "d" => 1, "e" => 3]))->toSet()
        );
    }
}