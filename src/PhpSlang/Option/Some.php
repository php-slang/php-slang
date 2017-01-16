<?php

namespace PhpSlang\Option;

use Closure;
use TypeError;

class Some extends Option
{
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    final public function map(Closure $expression): Option
    {
        return new Some($expression($this->content));
    }

    final public function flatMap(Closure $expression): Option
    {
        $result = $expression($this->content);
        if (!$result instanceof Option) {
            throw new TypeError("Closure passed to flatMap must return Option.");
        }

        return $result;
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

    final public function isEmpty(): bool
    {
        return false;
    }

    final public function isNotEmpty(): bool
    {
        return true;
    }
}
