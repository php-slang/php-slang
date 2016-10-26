<?php

namespace PhpSlang\Collection\Generic;

use Closure;
use PhpSlang\Collection\HashMapCollection;
use PhpSlang\Collection\SetCollection;
use PhpSlang\Tuple\Tuple2;

abstract class AbstractCollectionWithPartitioning extends AbstractCollectionWithAliases
{
    public function partition(Closure $expression, SetCollection $predefinedGroups = null) : HashMapCollection
    {
        return $this->pairsToHashMap(
            $this->toPairs($expression),
            !is_null($predefinedGroups) ? $predefinedGroups : new SetCollection([])
        );
    }

    private function toPairs(Closure $expression) : Collection
    {
        return $this->map(function ($item) use ($expression) {
            return new Tuple2($expression($item), $item);
        });
    }

    private function pairsToHashMap(Collection $pairs, SetCollection $predefinedGroups = null) : HashMapCollection
    {
        return new HashMapCollection(
            $this
                ->allGroupNamesOf($pairs, $predefinedGroups)
                ->map($this->groupElementsFor($pairs))
                ->toArray()
        );
    }

    private function allGroupNamesOf(Collection $pairs, SetCollection $predefinedGroups = null) : SetCollection
    {
        return $pairs
            ->map(function (Tuple2 $pair) {
                return $pair->_1();
            })
            ->toSet()
            ->merge($predefinedGroups);
    }

    private function groupElementsFor(Collection $pairs) : Closure
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