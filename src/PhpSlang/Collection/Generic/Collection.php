<?php

namespace PhpSlang\Collection\Generic;

use Closure;
use PhpSlang\Collection\HashMapCollection;
use PhpSlang\Collection\ListCollection;
use PhpSlang\Collection\SetCollection;
use PhpSlang\Option\Option;

interface Collection
{
    public static function of(array $array): Collection;

    public function map(Closure $expression): Collection;

    public function flatMap(Closure $expression): Collection;

    public function flatten(): Collection;

    public function get($index);

    public function getOption($index): Option;

    public function head();

    public function headOption(): Option;

    public function first();

    public function firstOption(): Option;

    public function tail(): Collection;

    public function slice(int $startAt, int $count): Collection;

    public function every(int $whichOne, bool $keep = true): Collection;

    public function withEvery(int $whichOne): Collection;

    public function withoutEvery(int $whichOne): Collection;

    public function last();

    public function lastOption(): Option;

    public function reversed(): Collection;

    public function sum();

    public function avg(): Option;

    public function min(Closure $expression = null): Option;

    public function max(Closure $expression = null): Option;

    public function partition(Closure $expression, SetCollection $predefinedGroups = null): HashMapCollection;

    public function groupBy(Closure $expression, SetCollection $predefinedGroups = null): HashMapCollection;

    public function count(Closure $expression = null): int;

    public function size(): int;

    public function isEmpty(): bool;

    public function isNotEmpty(): bool;

    public function any(Closure $expression): Option;

    public function has(Closure $expression): bool;

    public function hasNot(Closure $expression): bool;

    public function hasValue($compareWith): bool;

    public function hasNotValue($compareWith): bool;

    public function indexOf(Closure $expression): int;

    public function filter(Closure $expression): Collection;

    public function filterNot(Closure $expression): Collection;

    public function chunks(int $chunkSize): Collection;

    public function groups(int $groupsCount): Collection;

    public function fold($startWith, Closure $expression);

    public function foldLeft($startWith, Closure $expression);

    public function foldRight($startWith, Closure $expression);

    public function diff(Collection $compareTo): Collection;

    public function diffLeft(Collection $compareTo): Collection;

    public function diffRight(Collection $compareTo): Collection;

    public function intersection(Collection $compareTo): Collection;

    public function merge(Collection $with): Collection;

    public function toArray(): array;

    public function toList(): ListCollection;

    public function toHashMap(): HashMapCollection;

    public function toSet(): SetCollection;

    public function sort(Closure $by = null): Collection;

    public function unique(): Collection;

    public function distinct(): Collection;
}
