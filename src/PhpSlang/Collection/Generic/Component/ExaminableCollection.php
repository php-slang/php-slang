<?php

namespace PhpSlang\Collection\Generic\Component;

use Closure;
use PhpSlang\Option\Option;
use PhpSlang\Util\U;

trait ExaminableCollection
{
    use CollectionWithContent;

    final public function size(): int
    {
        return count($this->content);
    }

    final public function isEmpty(): bool
    {
        return $this->size() == 0;
    }

    final public function isNotEmpty(): bool
    {
        return $this->size() > 0;
    }

    final public function count(Closure $expression = null): int
    {
        return $expression ? $this->filter($expression)->size() : $this->size();
    }

    final public function avg(): Option
    {
        return Option::of($this->size(), 0)
            ->map(function ($size) {
                return $this->sum() / $size;
            });
    }

    final public function min(Closure $expression = null): Option
    {
        return $this->minExpr(!is_null($expression) ? $expression : U::dummyMap());
    }

    final protected function minExpr(Closure $expression): Option
    {
        return $this->headOption()
            ->map(function ($head) use ($expression) {
                return $this->fold($head, function ($min, $item) use ($expression) {
                    return ($expression($item) < $expression($min)) ? $item : $min;
                });
            });
    }

    final public function max(Closure $expression = null): Option
    {
        return $this->maxExpr(!is_null($expression) ? $expression : U::dummyMap());
    }

    final protected function maxExpr(Closure $expression): Option
    {
        return $this->headOption()
            ->map(function ($head) use ($expression) {
                return $this->fold($head, function ($max, $item) use ($expression) {
                    return ($expression($item) > $expression($max)) ? $item : $max;
                });
            });
    }

    final public function has(Closure $expression): bool
    {
        return $this->any($expression)->isNotEmpty();
    }

    final public function hasNot(Closure $expression): bool
    {
        return $this->any($expression)->isEmpty();
    }

    final public function hasValue($compareWith): bool
    {
        foreach ($this->content as $item) {
            if ($compareWith == $item) {
                return true;
            }
        }
        return false;
    }

    final public function hasNotValue($compareWith): bool
    {
        foreach ($this->content as $item) {
            if ($compareWith == $item) {
                return false;
            }
        }
        return true;
    }
}