<?php

declare(strict_types=1);

namespace PhpSlang\Option;

use PHPUnit_Framework_TestCase;

class OptionTest extends PHPUnit_Framework_TestCase
{
    public function testOptionOf()
    {
        $this->assertInstanceOf(Some::class, Some::of(1));
        $this->assertInstanceOf(None::class, Some::of(null));
    }
}
