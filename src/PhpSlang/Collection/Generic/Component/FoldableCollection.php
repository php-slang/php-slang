<?php

namespace PhpSlang\Collection\Generic\Component;

use Closure;

trait FoldableCollection
{
    use CollectionWithContent;

    /**
     * @param         $startWith
     * @param Closure $expression
     *
     * @return mixed
     */
    public function fold($startWith, Closure $expression)
    {
        return array_reduce($this->content, $expression, $startWith);
    }

    /**
     * @param         $startWith
     * @param Closure $expression
     *
     * @return mixed
     */
    public function reduce($startWith, Closure $expression)
    {
        return $this->fold($startWith, $expression);
    }

    /**
     * @param         $startWith
     * @param Closure $expression
     *
     * @return mixed
     */
    final public function foldLeft($startWith, Closure $expression)
    {
        return $this->fold($startWith, $expression);
    }

    /**
     * @param         $startWith
     * @param Closure $expression
     *
     * @return mixed
     */
    final public function foldRight($startWith, Closure $expression)
    {
        return $this->reversed()->fold($startWith, $expression);
    }
}