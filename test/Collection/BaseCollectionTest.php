<?php

declare(strict_types=1);

namespace PhpSlang\Collection;

use PhpSlang\Collection\Generic\Collection;
use PHPUnit\Framework\TestCase;

abstract class BaseCollectionTest extends TestCase
{
    /**
     * @dataProvider validElementsProvider
     */
    public function testIterator(array $elements)
    {
        $collection = $this->createCollection($elements);
        $iterations = 0;

        foreach ($collection as $key => $item) {
            $this->assertSame($elements[$key], $item);
            ++$iterations;
        }

        $this->assertEquals(count($elements), $iterations);
    }

    /**
     * @dataProvider validElementsProvider
     */
    public function testKey(array $elements)
    {
        $collection = $this->createCollection($elements);
        $this->assertSame(key($elements), $collection->key());

        $collection->next();
        next($elements);
        $this->assertSame(key($elements), $collection->key());
    }

    /**
     * @dataProvider validElementsProvider
     */
    public function testCurrent(array $elements)
    {
        $collection = $this->createCollection($elements);
        $this->assertSame(current($elements), $collection->current());

        next($elements);
        $collection->next();

        $this->assertSame(current($elements), $collection->current());
    }

    /**
     * @dataProvider validElementsProvider
     */
    public function testNext(array $elements)
    {
        $collection = $this->createCollection($elements);

        while (true) {
            $collectionNext = $collection->next();
            $arrayNext = next($elements);

            if (!$collectionNext && !$arrayNext) {
                break;
            }

            $this->assertSame($arrayNext, $collectionNext);
            $this->assertSame(key($elements), $collection->key());
            $this->assertSame(current($elements), $collection->current());
        }
    }

    abstract public function validElementsProvider(): array;

    abstract protected function createCollection(array $elements = []) : Collection;
}
