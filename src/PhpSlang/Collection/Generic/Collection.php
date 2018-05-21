<?php

declare(strict_types=1);

namespace PhpSlang\Collection\Generic;

use Closure;
use PhpSlang\Collection\HashMapCollection;
use PhpSlang\Collection\ListCollection;
use PhpSlang\Collection\SetCollection;
use PhpSlang\Option\Option;

interface Collection
{
    /**
     * @param array $array
     *
     * @return Collection
     */
    public static function of(array $array): self;

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function map(Closure $expression): self;

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function flatMap(Closure $expression): self;

    /**
     * @return Collection
     */
    public function flatten(): self;

    /**
     * @param $index
     *
     * @return mixed
     */
    public function get($index);

    /**
     * @param $index
     *
     * @return Option
     */
    public function getOption($index): Option;

    /**
     * @return mixed
     */
    public function head();

    /**
     * @return Option
     */
    public function headOption(): Option;

    /**
     * @return mixed
     */
    public function first();

    /**
     * @return Option
     */
    public function firstOption(): Option;

    /**
     * @return Collection
     */
    public function tail(): self;

    /**
     * @param int $startAt
     * @param int $count
     *
     * @return Collection
     */
    public function slice(int $startAt, int $count): self;

    /**
     * @param int  $whichOne
     * @param bool $keep
     *
     * @return Collection
     */
    public function every(int $whichOne, bool $keep = true): self;

    /**
     * @param int $whichOne
     *
     * @return Collection
     */
    public function withEvery(int $whichOne): self;

    /**
     * @param int $whichOne
     *
     * @return Collection
     */
    public function withoutEvery(int $whichOne): self;

    /**
     * @return mixed
     */
    public function last();

    /**
     * @return Option
     */
    public function lastOption(): Option;

    /**
     * @return Collection
     */
    public function reversed(): self;

    /**
     * @return Option
     */
    public function sum(): Option;

    /**
     * @return Option
     */
    public function avg(): Option;

    /**
     * @param Closure|null $expression
     *
     * @return Option
     */
    public function min(Closure $expression = null): Option;

    /**
     * @param Closure|null $expression
     *
     * @return Option
     */
    public function max(Closure $expression = null): Option;

    /**
     * @param Closure            $expression
     * @param SetCollection|null $predefinedGroups
     *
     * @return HashMapCollection
     */
    public function partition(Closure $expression, SetCollection $predefinedGroups = null): HashMapCollection;

    /**
     * @param Closure            $expression
     * @param SetCollection|null $predefinedGroups
     *
     * @return HashMapCollection
     */
    public function groupBy(Closure $expression, SetCollection $predefinedGroups = null): HashMapCollection;

    /**
     * @param Closure|null $expression
     *
     * @return int
     */
    public function count(Closure $expression = null): int;

    /**
     * @return int
     */
    public function size(): int;

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * @return bool
     */
    public function isNotEmpty(): bool;

    /**
     * @param Closure $expression
     *
     * @return Option
     */
    public function any(Closure $expression): Option;

    /**
     * @param Closure $expression
     *
     * @return bool
     */
    public function has(Closure $expression): bool;

    /**
     * @param Closure $expression
     *
     * @return bool
     */
    public function hasNot(Closure $expression): bool;

    /**
     * @param $compareWith
     *
     * @return bool
     */
    public function hasValue($compareWith): bool;

    /**
     * @param $compareWith
     *
     * @return bool
     */
    public function hasNotValue($compareWith): bool;

    /**
     * @param Closure $expression
     *
     * @return int
     */
    public function indexOf(Closure $expression): int;

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function filter(Closure $expression): self;

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function filterNot(Closure $expression): self;

    /**
     * @param int $chunkSize
     *
     * @return Collection
     */
    public function chunks(int $chunkSize): self;

    /**
     * @param int $groupsCount
     *
     * @return Collection
     */
    public function groups(int $groupsCount): self;

    /**
     * @param         $startWith
     * @param Closure $expression
     *
     * @return mixed
     */
    public function fold($startWith, Closure $expression);

    /**
     * @param         $startWith
     * @param Closure $expression
     *
     * @return mixed
     */
    public function reduce($startWith, Closure $expression);

    /**
     * @param         $startWith
     * @param Closure $expression
     *
     * @return mixed
     */
    public function foldLeft($startWith, Closure $expression);

    /**
     * @param         $startWith
     * @param Closure $expression
     *
     * @return mixed
     */
    public function foldRight($startWith, Closure $expression);

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function diff(self $compareTo): self;

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function diffLeft(self $compareTo): self;

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function diffRight(self $compareTo): self;

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function intersection(self $compareTo): self;

    /**
     * @param Collection $with
     *
     * @return Collection
     */
    public function merge(self $with): self;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return ListCollection
     */
    public function toList(): ListCollection;

    /**
     * @return HashMapCollection
     */
    public function toHashMap(): HashMapCollection;

    /**
     * @return SetCollection
     */
    public function toSet(): SetCollection;

    /**
     * @param Closure|null $by
     *
     * @return Collection
     */
    public function sort(Closure $by = null): self;

    /**
     * @param Closure $by
     *
     * @return Collection
     */
    public function sortBy(Closure $by): self;

    /**
     * @return Collection
     */
    public function unique(): self;

    /**
     * @return Collection
     */
    public function distinct(): self;
}
