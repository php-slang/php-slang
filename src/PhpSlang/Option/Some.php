<?php

namespace PhpSlang\Option;

use Closure;

class Some extends Option
{
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    final public function map(Closure $expression) : Option
    {
        return new Some($expression($this->content));
    }

    final public function flatMap(Closure $expression) : Option
    {
        return new Some($this->content->getOrElse(new None));
    }

    final public function get()
    {
        return $this->content;
    }

    final public function getOrElse($default)
    {
        return $this->content;
    }

    final public function getOrCall(Closure $defaultExpression)
    {
        return $this->content;
    }

    final public function isEmpty() : bool
    {
        return false;
    }
}