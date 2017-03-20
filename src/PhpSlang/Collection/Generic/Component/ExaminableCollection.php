<?php declare(strict_types=1);

namespace PhpSlang\Collection\Generic\Component;

use Closure;
use PhpSlang\Option\Option;
use PhpSlang\Util\U;

trait ExaminableCollection
{
    use CollectionWithContent;

    /**
     * @return int
     */
    final public function size(): int
    {
        return count($this->content);
    }

    /**
     * @return bool
     */
    final public function isEmpty(): bool
    {
        return $this->size() == 0;
    }

    /**
     * @return bool
     */
    final public function isNotEmpty(): bool
    {
        return $this->size() > 0;
    }

    /**
     * @param Closure|null $expression
     *
     * @return int
     */
    final public function count(Closure $expression = null): int
    {
        return $expression ? $this->filter($expression)->size() : $this->size();
    }

    /**
     * @return Option
     */
    final public function avg(): Option
    {
        return $this
            ->sum()
            ->map(function ($sum) {
                return $sum / $this->size();
            });
    }

    /**
     * @param Closure|null $expression
     *
     * @return Option
     */
    final public function min(Closure $expression = null): Option
    {
        return $this->minExpr(!is_null($expression) ? $expression : U::dummyMap());
    }

    /**
     * @param Closure $expression
     *
     * @return Option
     */
    final protected function minExpr(Closure $expression): Option
    {
        return $this->headOption()
            ->map(function ($head) use ($expression) {
                return $this->fold($head, function ($min, $item) use ($expression) {
                    return ($expression($item) < $expression($min)) ? $item : $min;
                });
            });
    }

    /**
     * @param Closure|null $expression
     *
     * @return Option
     */
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

    /**
     * @param Closure $expression
     *
     * @return bool
     */
    final public function has(Closure $expression): bool
    {
        return $this->any($expression)->isNotEmpty();
    }

    /**
     * @param Closure $expression
     *
     * @return bool
     */
    final public function hasNot(Closure $expression): bool
    {
        return $this->any($expression)->isEmpty();
    }

    /**
     * @param $compareWith
     *
     * @return bool
     */
    final public function hasValue($compareWith): bool
    {
        return in_array($compareWith, $this->content, true);
    }

    /**
     * @param $compareWith
     *
     * @return bool
     */
    final public function hasNotValue($compareWith): bool
    {
        return !in_array($compareWith, $this->content, true);
    }
}