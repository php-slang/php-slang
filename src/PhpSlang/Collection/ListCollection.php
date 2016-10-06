<?php

namespace PhpSlang\Collection;

use Closure;
use PhpSlang\Collection\Generic\AbstractCollection;
use PhpSlang\Collection\Generic\Collection;
use PhpSlang\Exception\ImproperCollectionInputException;

class ListCollection extends AbstractCollection
{
    public function __construct(array $array = [])
    {
        foreach ($array as $key => $item) {
            if (!is_numeric($key)) {
                throw new ImproperCollectionInputException(
                    'Immutable list can contain only linear data. Use HashMapCollection for storing key, value data.');
            }
        }
        $this->content = array_values($array);
    }

    public static function of(array $array) : Collection
    {
        return new ListCollection($array);
    }

    public function map(Closure $expression) : Collection
    {
        return new ListCollection(array_map($expression, $this->content));
    }

    public function flatMap(Closure $expression) : Collection
    {
        return $this->fold(
            new ListCollection(),
            function (ListCollection $accumulated, ListCollection $current) use ($expression) {
                return $accumulated->merge($current->map($expression));
            });
    }

    public function flatten() : Collection
    {
        return $this->fold(
            new ListCollection(),
            function (ListCollection $accumulated, ListCollection $current) : ListCollection {
                return $accumulated->merge($current);
            });
    }

    public function slice(int $startAt, int $count) : Collection
    {
        return new ListCollection(array_slice($this->content, $startAt, $count));
    }

    public function every(int $whichOne, bool $keep = true) : Collection
    {
        return new ListCollection(array_filter($this->content, function ($key) use ($whichOne, $keep) {
            return (($key + 1) % $whichOne === 0 && $keep) || (($key + 1) % $whichOne !== 0 && !$keep);
        }, ARRAY_FILTER_USE_KEY));
    }

    public function reversed() : Collection
    {
        return new ListCollection(array_reverse($this->content));
    }

    public function sum()
    {
        return array_sum($this->content);
    }

    public function partition(Closure $expression, SetCollection $predefinedGroups = null) : HashMapCollection
    {
        $map = $predefinedGroups ? $predefinedGroups->toArray() : [];
        foreach ($this->content as $item) {
            $map[$expression($item)] = $item;
        }
        return new HashMapCollection($map);
    }

    public function filter(Closure $expression) : Collection
    {
        return new ListCollection(array_filter($this->content, $expression));
    }

    public function filterNot(Closure $expression) : Collection
    {
        return new ListCollection(array_filter($this->content, function ($item) use ($expression) {
            return !$expression($item);
        }));
    }

    public function chunks(int $chunkSize) : Collection
    {
        return new ListCollection(array_map(function ($item) {
            return new ListCollection($item);
        }, array_chunk($this->content, $chunkSize)));
    }

    public function groups(int $groupsCount) : Collection
    {
        return new ListCollection(array_map(function ($item) {
            return new ListCollection($item);
        }, array_chunk($this->content, count($this->content) / $groupsCount)));
    }

    public function fold($startWith, Closure $expression)
    {
        return array_reduce($this->content, $expression, $startWith);
    }

    public function diff(Collection $compareTo) : Collection
    {
        return new ListCollection(array_merge(
            array_diff($this->content, $compareTo->toArray()),
            array_diff($compareTo->toArray(), $this->content)));
    }

    public function diffLeft(Collection $compareTo) : Collection
    {
        return new ListCollection(array_diff($this->content, $compareTo->toArray()));
    }

    public function diffRight(Collection $compareTo) : Collection
    {
        return new ListCollection(array_diff($compareTo->toArray(), $this->content));
    }

    public function intersection(Collection $compareTo) : Collection
    {
        return new ListCollection(array_intersect($this->content, $compareTo->toArray()));
    }

    public function merge(Collection $with) : Collection
    {
        return new ListCollection(array_merge($this->content, $with->toArray()));
    }

    final public function toArray() : array
    {
        return $this->content;
    }

    public function toList() : ListCollection
    {
        return clone $this;
    }

    public function toHashMap() : HashMapCollection
    {
        return new HashMapCollection($this->content);
    }

    public function toSet() : SetCollection
    {
        return new SetCollection($this->content);
    }

    public function sort(Closure $by = null) : Collection
    {
        $content = $this->content;
        usort($content, $by ? $by : function ($left, $right) {
            return $left > $right;
        });
        return new ListCollection($content);
    }

    public function unique() : Collection
    {
        return new ListCollection(array_unique($this->content));
    }
}
