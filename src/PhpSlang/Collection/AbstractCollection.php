<?php

namespace PhpSlang\Collection;

use Closure;
use PhpSlang\Option\Option;
use PhpSlang\Util\Util;

abstract class AbstractCollection implements Collection
{
    /**
     * @var array
     */
    protected $content;

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

    final public function toArray() : array
    {
        return $this->content;
    }

    final public function foldLeft($startWith, Closure $expression)
    {
        return $this->fold($startWith, $expression);
    }

    final public function groupBy(Closure $expression) : Collection
    {
        return $this->partition($expression);
    }

    final public function count(Closure $expression = null) : int
    {
        return $expression ? $this->filter($expression)->size() : $this->size();
    }

    final public function size() : int
    {
        return count($this->content);
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

    final public function avg() : Option
    {
        return Option::of($this->size(), 0)
            ->map(function ($size) {
                return $this->sum() / $size;
            });
    }

    final public function min(Closure $expression = null) : Option
    {
        return $this->minExpr(!is_null($expression) ? $expression : Util::dummyMap());
    }

    final protected function minExpr(Closure $expression) : Option
    {
        return $this->headOption()
            ->map(function ($head) use ($expression) {
                return $this->fold($expression($head), function ($min, $item) use ($expression) {
                    return ($expression($item) < $expression($min)) ? $item : $min;
                });
            });
    }

    final public function max(Closure $expression = null) : Option
    {
        return $this->maxExpr(!is_null($expression) ? $expression : Util::dummyMap());
    }

    final protected function maxExpr(Closure $expression) : Option
    {
        return $this->headOption()
            ->map(function ($head) use ($expression) {
                return $this->fold($expression($head), function ($min, $item) use ($expression) {
                    return ($expression($item) > $expression($min)) ? $item : $min;
                });
            });
    }

}