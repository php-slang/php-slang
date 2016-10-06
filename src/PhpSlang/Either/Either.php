<?php

namespace PhpSlang\Either;

use Closure;
use PhpSlang\Option\Option;

abstract class Either
{
    protected $content;

    abstract public function fold(Closure $expressionLeft, Closure $expressionRight);

    abstract public function left(Closure $expression) : Either;

    abstract public function right(Closure $expression) : Either;

    abstract public function flatLeft(Closure $expression) : Either;

    abstract public function flatRight(Closure $expression) : Either;

    abstract public function getLeftOption() : Option;

    abstract public function getRightOption() : Option;

    abstract public function isLeft() : bool;

    abstract public function isRight() : bool;

    public function get()
    {
        return $this->content;
    }

}
