<?php declare(strict_types=1);

namespace PhpSlang\Util;

use Closure;

class U
{
    /**
     * @return Closure
     */
    final public static function dummyMap(): Closure
    {
        return function ($item) {
            return $item;
        };
    }
}
