<?php

namespace PhpSlang\Collection\Generic;

use Closure;
use PhpSlang\Option\Option;

abstract class AbstractCollectionWithAliases extends AbstractCollectionWithGetters
{
    final public function first()
    {
        return $this->head();
    }

    final public function firstOption() : Option
    {
        return $this->headOption();
    }

    final public function isEmpty() : bool
    {
        return $this->size() == 0;
    }

    final public function isNotEmpty() : bool
    {
        return $this->size() > 0;
    }

    final public function foldLeft($startWith, Closure $expression)
    {
        return $this->fold($startWith, $expression);
    }

    final public function foldRight($startWith, Closure $expression)
    {
        return $this->reversed()->fold($startWith, $expression);
    }

    final public function groupBy(Closure $expression) : Collection
    {
        return $this->partition($expression);
    }

    final public function distinct() : Collection
    {
        return $this->unique();
    }

    final public function withEvery(int $whichOne) : Collection
    {
        return $this->every($whichOne);
    }

    final public function withoutEvery(int $whichOne) : Collection
    {
        return $this->every($whichOne, false);
    }

}
