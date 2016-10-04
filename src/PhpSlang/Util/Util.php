<?php

namespace PhpSlang\Util;

use Closure;

class Util
{
    final public static function dummyMap() : Closure
    {
        return function ($item) {
            return $item;
        };
    }
}