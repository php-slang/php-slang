<?php

namespace PhpSlang\Collection;

use Closure;
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
        $this->content = $array;
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

    public function reversed() : Collection
    {
        return new ListCollection(array_reverse($this->content));
    }

    public function sum(Closure $expression = null)
    {
        return array_sum($this->map($expression ? $expression : function ($a, $b) {
            return $a + $b;
        })->toArray());
    }

    public function partition(Closure $expression, SetCollection $predefinedGroups = null) : Collection
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

    public function groups(int $groupsCount) : Collection
    {
        return new ListCollection(array_chunk($this->content, $groupsCount));
    }

    public function fold($startWith, Closure $expression)
    {
        return new ListCollection(array_reduce($this->content, $expression, $startWith));
    }

    public function diff(Collection $compareTo) : Collection
    {
        return new ListCollection(array_diff($this->content, $compareTo->toArray()));
    }

    public function intersection(Collection $compareTo) : Collection
    {
        return new ListCollection(array_intersect($this->content, $compareTo->toArray()));
    }

    public function merge(Collection $with) : Collection
    {
        return new ListCollection(array_merge($this->content, $with->toArray()));
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

    public function sortBy(Closure $expression) : Collection
    {
        $content = $this->content;
        usort($content, $expression);
        return new ListCollection($content);
    }

    public function unique() : Collection
    {
        return new ListCollection(array_unique($this->content));
    }
}