<?php

declare(strict_types=1);

namespace PhpSlang\Collection;

use PhpSlang\Collection\Generic\Collection;
use PHPUnit_Framework_TestCase;

class HashMapTest extends BaseCollectionTest
{
    public function testToList()
    {
        $this->assertEquals(
            new ListCollection([1, 2, 3]),
            (new HashMapCollection(['a' => 1, 'b' => 2, 'c' => 3]))->toList()
        );
    }

    public function testToSet()
    {
        $this->assertEquals(
            new SetCollection([1, 2, 3]),
            (new HashMapCollection(['a' => 1, 'b' => 2, 'c' => 1, 'd' => 1, 'e' => 3]))->toSet()
        );
    }

    public function validElementsProvider(): array
    {
        return [
            'simple' => [[1, 2, 3, 4, 5]],
            'associative' => [['a' => 'A', 'b' => 'B', 'c' => 'C']],
            'mixed' => [['a' => 'A', 'b' => 'B', 1, 2, 3]],
        ];
    }

    protected function createCollection(array $elements = []): Collection
    {
        return new HashMapCollection($elements);
    }
}
