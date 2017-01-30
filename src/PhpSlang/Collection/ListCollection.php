<?php

namespace PhpSlang\Collection;

use Closure;
use PhpSlang\Collection\Generic\AbstractCollection;
use PhpSlang\Collection\Generic\Collection;
use PhpSlang\Exception\ImproperCollectionInputException;

class ListCollection extends AbstractCollection
{
    /**
     * ListCollection constructor.
     *
     * @param array $array
     *
     * @throws ImproperCollectionInputException
     */
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

    /**
     * @param array $array
     *
     * @return Collection
     */
    public static function of(array $array): Collection
    {
        return new ListCollection($array);
    }

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function map(Closure $expression): Collection
    {
        return new ListCollection(array_map($expression, $this->content));
    }

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function flatMap(Closure $expression): Collection
    {
        return $this->fold(
            new ListCollection(),
            function (ListCollection $accumulated, $current) use ($expression) {
                return $accumulated->merge($expression($current));
            });
    }

    /**
     * @return Collection
     */
    public function flatten(): Collection
    {
        return $this->fold(
            new ListCollection(),
            function (ListCollection $accumulated, ListCollection $current): ListCollection {
                return $accumulated->merge($current);
            });
    }

    /**
     * @param int $startAt
     * @param int $count
     *
     * @return Collection
     */
    public function slice(int $startAt, int $count): Collection
    {
        return new ListCollection(array_slice($this->content, $startAt, $count));
    }

    /**
     * @param int  $whichOne
     * @param bool $keep
     *
     * @return Collection
     */
    public function every(int $whichOne, bool $keep = true): Collection
    {
        return new ListCollection(array_filter($this->content, function ($key) use ($whichOne, $keep) {
            return (($key + 1) % $whichOne === 0 && $keep) || (($key + 1) % $whichOne !== 0 && !$keep);
        }, ARRAY_FILTER_USE_KEY));
    }

    /**
     * @return Collection
     */
    public function reversed(): Collection
    {
        return new ListCollection(array_reverse($this->content));
    }

    /**
     * @return float|int
     */
    public function sum()
    {
        return array_sum($this->content);
    }

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function filter(Closure $expression): Collection
    {
        return new self(array_filter($this->content, $expression));
    }

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function filterNot(Closure $expression): Collection
    {
        return new ListCollection(array_filter($this->content, function ($item) use ($expression) {
            return !$expression($item);
        }));
    }

    /**
     * @param int $chunkSize
     *
     * @return Collection
     */
    public function chunks(int $chunkSize): Collection
    {
        return new ListCollection(array_map(function ($item) {
            return new ListCollection($item);
        }, array_chunk($this->content, $chunkSize)));
    }

    /**
     * @param int $groupsCount
     *
     * @return Collection
     */
    public function groups(int $groupsCount): Collection
    {
        return new ListCollection(array_map(function ($item) {
            return new ListCollection($item);
        }, array_chunk($this->content, count($this->content) / $groupsCount)));
    }

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function diff(Collection $compareTo): Collection
    {
        return new ListCollection(array_merge(
            array_diff($this->content, $compareTo->toArray()),
            array_diff($compareTo->toArray(), $this->content)));
    }

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function diffLeft(Collection $compareTo): Collection
    {
        return new ListCollection(array_diff($this->content, $compareTo->toArray()));
    }

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function diffRight(Collection $compareTo): Collection
    {
        return new ListCollection(array_diff($compareTo->toArray(), $this->content));
    }

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function intersection(Collection $compareTo): Collection
    {
        return new ListCollection(array_intersect($this->content, $compareTo->toArray()));
    }

    /**
     * @param Collection $with
     *
     * @return Collection
     */
    public function merge(Collection $with): Collection
    {
        return new ListCollection(array_merge($this->content, $with->toArray()));
    }

    /**
     * @param Closure|null $by
     *
     * @return Collection
     */
    public function sort(Closure $by = null): Collection
    {
        $content = $this->content;
        usort($content, $by ? $by : function ($left, $right) {
            return $left > $right;
        });
        return new ListCollection($content);
    }

    /**
     * @return Collection
     */
    public function unique(): Collection
    {
        return new ListCollection(array_unique($this->content));
    }
}
