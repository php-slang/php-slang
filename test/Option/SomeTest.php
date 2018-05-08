<?php

declare(strict_types=1);

namespace PhpSlang\Option;

use PHPUnit\Framework\TestCase;
use TypeError;

class SomeTest extends TestCase
{
    public function testGet()
    {
        $this->assertEquals(1, Some::of(1)->get());
    }

    public function testMap()
    {
        $this->assertEquals(
            new Some(6),
            (new Some(3))
                ->map(function (int $a) {
                    return $a * 2;
                })
        );
    }

    public function testFlatMap()
    {
        $this->assertEquals(
            new Some(6),
            (new Some(3))
                ->flatMap(function ($a) {
                    return new Some($a * 2);
                })
        );
    }

    public function testFlatMapImproperUsage()
    {
        $this->expectException(TypeError::class);
        (new Some(3))
            ->flatMap(function ($a) {
                return $a * 2;
            });
    }
}
