<?php

namespace PhpSlang\Util;

use Closure;

class U
{
    final public static function dummyMap() : Closure
    {
        return function ($item) {
            return $item;
        };
    }

    final public static function curry($target, string $functionName) : Closure
    {
        return function () use ($target, $functionName) {
            return $target->$functionName();
        };
    }
}