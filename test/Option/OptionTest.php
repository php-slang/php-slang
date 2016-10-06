<?php

namespace PhpSlang\Option;

use PhpSlang\Exception\NoContentException;
use PHPUnit_Framework_TestCase;

class OptionTest extends PHPUnit_Framework_TestCase
{
    public function testOptionOf()
    {
        $this->assertInstanceOf(Some::class, Some::of(1));
        $this->assertInstanceOf(None::class, Some::of(null));
    }

    public function testSomeGet()
    {
        $this->assertEquals(2, Some::of(1)
            ->map(function ($el) {
                return $el * 2;
            })
            ->get());
    }

    public function testNoneGet()
    {
        $this->expectException(NoContentException::class);
        Some::of(null)->map(function ($el) {
            return $el * 2;
        })->get();
    }
}
