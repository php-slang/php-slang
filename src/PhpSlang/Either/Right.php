<?php

namespace PhpSlang\Either;

use Closure;
use PhpSlang\Option\None;
use PhpSlang\Option\Option;
use PhpSlang\Option\Some;

class Right extends Either
{

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function fold(Closure $expressionLeft, Closure $expressionRight)
    {
        return $this->right($expressionRight)->get();
    }

    public function left(Closure $expression) : Either
    {
        return new Right($this->get());
    }

    public function right(Closure $expression) : Either
    {
        return new Right($expression($this->get()));
    }

    public function getLeftOption() : Option
    {
        return new None();
    }

    public function getRightOption() : Option
    {
        return new Some($this->get());
    }

    public function flatLeft(Closure $expression) : Either
    {
        return new Right($this->get());
    }

    public function flatRight(Closure $expression) : Either
    {
        return $expression($this->get());
    }

    public function isLeft() : bool
    {
        return false;
    }

    public function isRight() : bool
    {
        return true;
    }
}