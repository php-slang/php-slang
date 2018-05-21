<?php

declare(strict_types=1);

namespace PhpSlang\Option;

use PHPUnit\Framework\TestCase;

class OptionTest extends TestCase
{
    public function testOptionOf()
    {
        $this->assertInstanceOf(Some::class, Some::of(1));
        $this->assertInstanceOf(None::class, Some::of(null));
    }
}
