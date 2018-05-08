<?php

declare(strict_types=1);

namespace PhpSlang\Collection\Generic\Component;

use Closure;
use PhpSlang\Collection\Generic\Collection;
use PhpSlang\Collection\HashMapCollection;
use PhpSlang\Collection\SetCollection;
use PhpSlang\Tuple\Tuple2;

trait PartitionableCollection
{
    use CollectionWithContent;

    /**
     * @param int $whichOne
     *
     * @return Collection
     */
    final public function withEvery(int $whichOne): Collection
    {
        return $this->every($whichOne);
    }

    /**
     * @param int $whichOne
     *
     * @return Collection
     */
    final public function withoutEvery(int $whichOne): Collection
    {
        return $this->every($whichOne, false);
    }

    /**
     * @param Closure            $expression
     * @param SetCollection|null $predefinedGroups
     *
     * @return HashMapCollection
     */
    final public function groupBy(Closure $expression, SetCollection $predefinedGroups = null): HashMapCollection
    {
        return $this->partition($expression, $predefinedGroups);
    }

    /**
     * @param Closure            $expression
     * @param SetCollection|null $predefinedGroups
     *
     * @return HashMapCollection
     */
    final public function partition(Closure $expression, SetCollection $predefinedGroups = null): HashMapCollection
    {
        return $this->pairsToHashMap(
            $this->toPairs($expression),
            !is_null($predefinedGroups)
                ? $predefinedGroups
                ->map(function ($item) {
                    return (string) $item;
                })
                ->toSet()
                : new SetCollection([])
        );
    }

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    final private function toPairs(Closure $expression): Collection
    {
        return $this->map(function ($item) use ($expression) {
            return new Tuple2((string) $expression($item), $item);
        });
    }

    /**
     * @param Collection    $pairs
     * @param SetCollection $predefinedGroups
     *
     * @return HashMapCollection
     */
    final private function pairsToHashMap(Collection $pairs, SetCollection $predefinedGroups): HashMapCollection
    {
        return $this
            ->allGroupNamesOf($pairs)
            ->merge($predefinedGroups)
            ->toHashMap()
            ->map($this->groupElementsFor($pairs))
            ->toHashMap();
    }

    /**
     * @param Collection $pairs
     *
     * @return SetCollection
     */
    final private function allGroupNamesOf(Collection $pairs): SetCollection
    {
        return $pairs
            ->map(function (Tuple2 $pair) {
                return $pair->_1();
            })
            ->toSet();
    }

    /**
     * @param Collection $pairs
     *
     * @return Closure
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    final private function groupElementsFor(Collection $pairs): Closure
    {
        return function ($item, $groupName) use ($pairs) {
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
