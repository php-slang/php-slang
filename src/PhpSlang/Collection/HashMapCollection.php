<?php

declare(strict_types=1);

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

        return new self(array_combine($allKeys, array_map($expression, $this->content, $allKeys)));
    }

    /**
     * @return ListCollection
     */
    public function toList(): ListCollection
    {
        return new ListCollection(array_values($this->content));
    }

    /**
     * @return HashMapCollection
     */
    public function toHashMap(): self
    {
        return new self($this->content);
    }

    /**
     * @return SetCollection
     */
    public function toSet(): SetCollection
    {
        return new SetCollection(array_values($this->content));
    }
}
