<?php

namespace PhpSlang\Collection\Generic\Component;

use Closure;
use PhpSlang\Collection\Generic\Collection;
use PhpSlang\Collection\HashMapCollection;
use PhpSlang\Collection\SetCollection;
use PhpSlang\Tuple\Tuple2;

trait PartitionableCollection
{
    use CollectionWithContent;

    final public function withEvery(int $whichOne) : Collection
    {
        return $this->every($whichOne);
    }

    final public function withoutEvery(int $whichOne) : Collection
    {
        return $this->every($whichOne, false);
    }

    final public function groupBy(Closure $expression, SetCollection $predefinedGroups = null) : HashMapCollection
    {
        return $this->partition($expression, $predefinedGroups);
    }

    final public function partition(Closure $expression, SetCollection $predefinedGroups = null) : HashMapCollection
    {
        return $this->pairsToHashMap(
            $this->toPairs($expression),
            !is_null($predefinedGroups)
                ? $predefinedGroups
                ->map(function ($item) {
                    return (string) $item;
                })
                : new SetCollection([])
        );
    }

    final private function toPairs(Closure $expression) : Collection
    {
        return $this->map(function ($item) use ($expression) {
            return new Tuple2((string) $expression($item), $item);
        });
    }

    final private function pairsToHashMap(Collection $pairs, SetCollection $predefinedGroups) : HashMapCollection
    {
        return $this
            ->allGroupNamesOf($pairs)
            ->merge($predefinedGroups)
            ->toHashMap()
            ->map($this->groupElementsFor($pairs));
    }

    final private function allGroupNamesOf(Collection $pairs) : SetCollection
    {
        return $pairs
            ->map(function (Tuple2 $pair) {
                return $pair->_1();
            })
            ->toSet();
    }

    final private function groupElementsFor(Collection $pairs) : Closure
    {
        return function ($groupName) use ($pairs) {
            return $pairs
                ->filter(function (Tuple2 $pair) use ($groupName) {
                    return $pair->_1() == $groupName;
                })
                ->map(function (Tuple2 $pair) {
                    return $pair->_2();
                });
        };
    }
}