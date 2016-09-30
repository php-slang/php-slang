<?php

namespace PhpSlang\Collection;

use Closure;
use PhpSlang\Exception\ImproperCollectionInputException;
use PhpSlang\Exception\InvalidArgumentException;
use PhpSlang\Exception\NoContentException;
use PhpSlang\Option\None;
use PhpSlang\Option\Option;
use PhpSlang\Option\Some;

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

    public function get($index)
    {
        if (!is_int($index)) {
            throw new InvalidArgumentException('List index must be int');
        }
        if (!isset($this[$index])) {
            throw new NoContentException();
        }
        return $this->content[$index];
    }

    public function getOption($index) : Option
    {
        if (!is_int($index)) {
            throw new InvalidArgumentException('List index must be int');
        }
        return isset($index, $this->content) ? new Some($this->content[$index]) : new None();
    }

    public function head()
    {
        return $this->get(0);
    }

    public function headOption() : Option
    {
        return $this->getOption(0);
    }

    public function tail() : Collection
    {
        return $this->slice(1, $this->size() - 1);
    }

    public function slice(int $startAt, int $count) : Collection
    {
        return new ListCollection(array_slice($this->content, $startAt, $count));
    }

    public function every(int $whichOne, bool $keep = true) : Collection
    {
        return $this->filter(function ($value, $key) use ($whichOne, $keep) {
            return (($key + 1) % $whichOne === 0 && $keep) || (($key + 1) % $whichOne !== 0 && !$keep);
        });
    }

    public function last()
    {
        $last = array_pop($this->content);
        if (is_null($last)) {
            throw new NoContentException();
        }

        return $last;
    }

    public function lastOption() : Option
    {
        return Option::of(array_pop($this->content));
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

    public function partition(Closure $expression) : Collection
    {
        $map = [];
        foreach ($this->content as $item) {
            $map[$expression($item)] = $item;
        }
        return new HashMapCollection($map);
    }

    public function any(Closure $expression) : Option
    {
        foreach ($this->content as $item) {
            if ($expression($item)) {
                return new Some($item);
            }
        }
        return new None();
    }

    public function has(Closure $expression) : bool
    {
        return $this->any($expression)->isNotEmpty();
    }

    public function hasNot(Closure $expression) : bool
    {
        return $this->any($expression)->isEmpty();
    }

    public function hasValue($compareWith) : bool
    {
        foreach ($this->content as $item) {
            if ($compareWith == $item) {
                return true;
            }
        }
        return false;
    }

    public function hasNotValue($compareWith) : bool
    {
        foreach ($this->content as $item) {
            if ($compareWith == $item) {
                return false;
            }
        }
        return true;
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

    public function foldRight($startWith, Closure $expression)
    {
        return $this->reversed()->fold($startWith, $expression);
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

    public function indexOf(Closure $expression) : int
    {
        foreach ($this->content as $index => $item) {
            if ($expression($item)) {
                return $index;
            }
        }
        return -1;
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