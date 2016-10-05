<?php

namespace PhpSlang\Collection\Generic;

use Closure;
use PhpSlang\Option\Option;
use PhpSlang\Util\U;

abstract class AbstractCollection extends AbstractCollectionWithAliases
{
    final public function count(Closure $expression = null) : int
    {
        return $expression ? $this->filter($expression)->size() : $this->size();
    }

    final public function size() : int
    {
        return count($this->content);
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
        return $this->minExpr(!is_null($expression) ? $expression : U::dummyMap());
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
        return $this->maxExpr(!is_null($expression) ? $expression : U::dummyMap());
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