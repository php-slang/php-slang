<?php

namespace PhpSlang\Collection;

use Closure;
use PhpSlang\Collection\Generic\AbstractCollection;
use PhpSlang\Collection\Generic\Collection;
use PhpSlang\Exception\NotYetImplementedException;

class SetCollection extends AbstractCollection
{
    /**
     * SetCollection constructor.
     *
     * @param array $array
     */
    public function __construct(array $array = [])
    {
        //This weird part is done so we can store the actual data inside array keys (which are always unique)
        $this->content = array_combine($array, array_fill(0, count($array), null));
    }

    public static function of(array $array): Collection
    {
        throw new NotYetImplementedException();
    }

    public function map(Closure $expression): Collection
    {
        return new SetCollection(array_map($expression, $this->content));
    }

    public function flatMap(Closure $expression): Collection
    {
        throw new NotYetImplementedException();
    }

    public function flatten(): Collection
    {
        throw new NotYetImplementedException();
    }

    public function slice(int $startAt, int $count): Collection
    {
        throw new NotYetImplementedException();
    }

    public function every(int $whichOne, bool $keep = true): Collection
    {
        throw new NotYetImplementedException();
    }

    public function reversed(): Collection
    {
        throw new NotYetImplementedException();
    }

    public function sum()
    {
        throw new NotYetImplementedException();
    }

    public function filter(Closure $expression): Collection
    {
        throw new NotYetImplementedException();
    }

    public function filterNot(Closure $expression): Collection
    {
        throw new NotYetImplementedException();
    }

    public function chunks(int $chunkSize): Collection
    {
        throw new NotYetImplementedException();
    }

    public function groups(int $groupsCount): Collection
    {
        throw new NotYetImplementedException();
    }

    public function diff(Collection $compareTo): Collection
    {
        throw new NotYetImplementedException();
    }

    public function diffLeft(Collection $compareTo): Collection
    {
        throw new NotYetImplementedException();
    }

    public function diffRight(Collection $compareTo): Collection
    {
        throw new NotYetImplementedException();
    }

    public function intersection(Collection $compareTo): Collection
    {
        throw new NotYetImplementedException();
    }

    /**
     * @param Collection $with
     *
     * @return Collection
     */
    public function merge(Collection $with): Collection
    {
        return new SetCollection(array_keys($this->content) + array_keys($with->toArray()));
    }

    public function sort(Closure $by = null): Collection
    {
        throw new NotYetImplementedException();
    }

    public function unique(): Collection
    {
        throw new NotYetImplementedException();
    }
}
