<?php

namespace PhpSlang\Option;

use Closure;
use PhpSlang\Exception\NoContentException;

class None extends Option
{
    public function __construct()
    {
    }

    final public function map(Closure $expression) : Option
    {
        return new None();
    }

    final public function flatMap(Closure $expression) : Option
    {
        return new None();
    }

    final public function get()
    {
        throw new NoContentException();
    }

    final public function getOrElse($default)
    {
        return $default;
    }

    final public function getOrCall(Closure $defaultExpression)
    {
        return $defaultExpression();
    }

    final public function isEmpty() : bool
    {
        return true;
    }
}