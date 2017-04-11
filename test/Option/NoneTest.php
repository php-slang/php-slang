<?php declare(strict_types=1);

namespace PhpSlang\Option;

use PhpSlang\Exception\NoContentException;
use PHPUnit_Framework_TestCase;

class NoneTest extends PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $this->expectException(NoContentException::class);
        Some::of(null)->map(function ($el) {
            return $el * 2;
        })->get();
    }

    public function testMap()
    {
        $this->assertEquals(
            new None(),
            (new None())
                ->map(function (int $a) {
                    return $a * 2;
                })
        );
    }

    public function testFlatMap()
    {
        $this->assertEquals(
            new None(),
            (new None())
                ->flatMap(function ($a) {
                    return $a;
                })
        );
    }
}
