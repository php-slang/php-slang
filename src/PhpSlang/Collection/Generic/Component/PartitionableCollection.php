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

    final public function groupBy(Closure $expression) : Collection
    {
        return $this->partition($expression);
    }

    final public function partition(Closure $expression, SetCollection $predefinedGroups = null) : HashMapCollection
    {
        return $this->pairsToHashMap(
            $this->toPairs($expression),
            !is_null($predefinedGroups) ? $predefinedGroups : new SetCollection([])
        );
    }

    final private function toPairs(Closure $expression) : Collection
    {
        return $this->map(function ($item) use ($expression) {
            return new Tuple2($expression($item), $item);
        });
    }

    final private function pairsToHashMap(Collection $pairs, SetCollection $predefinedGroups = null) : HashMapCollection
    {
        return new HashMapCollection(
            $this
                ->allGroupNamesOf($pairs, $predefinedGroups)
                ->map($this->groupElementsFor($pairs))
                ->toArray()
        );
    }

    final private function allGroupNamesOf(Collection $pairs, SetCollection $predefinedGroups = null) : SetCollection
    {
        return $pairs
            ->map(function (Tuple2 $pair) {
                return $pair->_1();
            })
            ->toSet()
            ->merge($predefinedGroups);
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