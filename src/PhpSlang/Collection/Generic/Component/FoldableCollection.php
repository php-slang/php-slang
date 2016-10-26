<?php

namespace PhpSlang\Collection\Generic\Component;

use Closure;

trait FoldableCollection
{
    use CollectionWithContent;

    public function fold($startWith, Closure $expression)
    {
        return array_reduce($this->content, $expression, $startWith);
    }

    final public function foldLeft($startWith, Closure $expression)
    {
        return $this->fold($startWith, $expression);
    }

    final public function foldRight($startWith, Closure $expression)
    {
        return $this->reversed()->fold($startWith, $expression);
    }
}