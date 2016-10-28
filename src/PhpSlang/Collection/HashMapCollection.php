<?php

namespace PhpSlang\Collection;

use Closure;
use PhpSlang\Collection\Generic\AbstractCollection;
use PhpSlang\Collection\Generic\Collection;
use PhpSlang\Exception\NotYetImplementedException;

class HashMapCollection extends AbstractCollection
{
    public function __construct(array $array = [])
    {
        $this->content = $array;
    }

    public static function of(array $array) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function map(Closure $expression) : Collection
    {
        $allKeys = array_keys($this->content);
        return new HashMapCollection(array_combine($allKeys, array_map($expression, $allKeys, $this->content)));
    }

    public function flatMap(Closure $expression) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function flatten() : Collection
    {
        throw new NotYetImplementedException();
    }

    public function slice(int $startAt, int $count) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function every(int $whichOne, bool $keep = true) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function reversed() : Collection
    {
        throw new NotYetImplementedException();
    }

    public function sum()
    {
        throw new NotYetImplementedException();
    }

    public function filter(Closure $expression) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function filterNot(Closure $expression) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function chunks(int $chunkSize) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function groups(int $groupsCount) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function diff(Collection $compareTo) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function diffLeft(Collection $compareTo) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function diffRight(Collection $compareTo) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function intersection(Collection $compareTo) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function merge(Collection $with) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function sort(Closure $by = null) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function unique() : Collection
    {
        throw new NotYetImplementedException();
    }
}
