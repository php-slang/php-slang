<?php

namespace PhpSlang\Collection;

use Closure;
use PhpSlang\Collection\Generic\AbstractCollection;
use PhpSlang\Collection\Generic\Collection;

class HashMapCollection extends AbstractCollection
{
    public function __construct(array $array = [])
    {
        $this->content = $array;
    }

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function map(Closure $expression): Collection
    {
        $allKeys = array_keys($this->content);
        return new HashMapCollection(array_combine($allKeys, array_map($expression, $this->content, $allKeys)));
    }
}
