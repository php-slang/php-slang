<?php

namespace PhpSlang\Either;

use Closure;
use PhpSlang\Option\None;
use PhpSlang\Option\Option;
use PhpSlang\Option\Some;

class Left extends Either
{

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function fold(Closure $expressionLeft, Closure $expressionRight)
    {
        return $this->left($expressionLeft)->get();
    }

    public function left(Closure $expression) : Either
    {
        return new Left($expression($this->get()));
    }

    public function right(Closure $expression) : Either
    {
        return new Left($this->get());
    }

    public function getLeftOption() : Option
    {
        return new Some($this->get());
    }

    public function getRightOption() : Option
    {
        return new None();
    }

    public function flatLeft(Closure $expression) : Either
    {
        return $expression($this->get());
    }

    public function flatRight(Closure $expression) : Either
    {
        return new Left($this->get());
    }

    public function isLeft() : bool
    {
        return true;
    }

    public function isRight() : bool
    {
        return false;
    }
}
