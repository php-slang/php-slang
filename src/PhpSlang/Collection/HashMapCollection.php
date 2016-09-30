<?php

namespace PhpSlang\Collection;

use Closure;
use PhpSlang\Exception\NotYetImplementedException;
use PhpSlang\Option\Option;

class HashMapCollection extends AbstractCollection
{
    public function __construct(array $arrayMap)
    {
        throw new NotYetImplementedException();
    }

    public static function of(array $array) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function map(Closure $expression) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function flatMap(Closure $expression) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function flatten() : Collection
    {
        throw new NotYetImplementedException();
    }

    public function get($index)
    {
        throw new NotYetImplementedException();
    }

    public function getOption($index) : Option
    {
        throw new NotYetImplementedException();
    }

    public function head()
    {
        throw new NotYetImplementedException();
    }

    public function headOption() : Option
    {
        throw new NotYetImplementedException();
    }

    public function tail() : Collection
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

    public function last()
    {
        throw new NotYetImplementedException();
    }

    public function lastOption() : Option
    {
        throw new NotYetImplementedException();
    }

    public function reversed() : Collection
    {
        throw new NotYetImplementedException();
    }

    public function sum(Closure $expression = null)
    {
        throw new NotYetImplementedException();
    }

    public function partition(Closure $expression) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function any(Closure $expression) : Option
    {
        throw new NotYetImplementedException();
    }

    public function has(Closure $expression) : bool
    {
        throw new NotYetImplementedException();
    }

    public function hasNot(Closure $expression) : bool
    {
        throw new NotYetImplementedException();
    }

    public function hasValue($compareWith) : bool
    {
        throw new NotYetImplementedException();
    }

    public function hasNotValue($compareWith) : bool
    {
        throw new NotYetImplementedException();
    }

    public function indexOf(Closure $expression) : int
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

    public function groups(int $groupsCount) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function fold($startWith, Closure $expression)
    {
        throw new NotYetImplementedException();
    }

    public function foldRight($startWith, Closure $expression)
    {
        throw new NotYetImplementedException();
    }

    public function diff(Collection $compareTo) : Collection
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

    public function toList() : ListCollection
    {
        throw new NotYetImplementedException();
    }

    public function toHashMap() : HashMapCollection
    {
        throw new NotYetImplementedException();
    }

    public function toSet() : SetCollection
    {
        throw new NotYetImplementedException();
    }

    public function sortBy(Closure $expression) : Collection
    {
        throw new NotYetImplementedException();
    }

    public function unique() : Collection
    {
        throw new NotYetImplementedException();
    }
}