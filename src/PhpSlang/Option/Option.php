<?php

namespace PhpSlang\Option;

use Closure;

abstract class Option
{
    final public static function of($content, $empty = null)
    {
        return ($content == $empty) ? new None() : new Some($content);
    }

    abstract public function map(Closure $expression) : Option;

    abstract public function flatMap(Closure $expression) : Option;

    abstract public function get();

    abstract public function getOrElse($default);

    abstract public function getOrCall(Closure $defaultExpression);

    abstract public function isEmpty() : bool;
}