<?php

declare(strict_types=1);

namespace PhpSlang\Collection\Generic;

use Closure;
use PhpSlang\Collection\Generic\Component\AccessibleCollection;
use PhpSlang\Collection\Generic\Component\ExaminableCollection;
use PhpSlang\Collection\Generic\Component\FoldableCollection;
use PhpSlang\Collection\Generic\Component\PartitionableCollection;
use PhpSlang\Collection\Generic\Component\TransformableCollection;
use PhpSlang\Option\None;
use PhpSlang\Option\Option;
use PhpSlang\Option\Some;

abstract class AbstractCollection implements Collection
{
    use AccessibleCollection;
    use ExaminableCollection;
    use FoldableCollection;
    use PartitionableCollection;
    use TransformableCollection;

    /**
     * @param array $array
     *
     * @return Collection
     */
    public static function of(array $array): Collection
    {
        return new static($array);
    }

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function map(Closure $expression): Collection
    {
        return new static(array_map($expression, $this->content));
    }

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function flatMap(Closure $expression): Collection
    {
        return $this->fold(
            new static(),
            function (Collection $accumulated, $current) use ($expression) {
                return $accumulated->merge($expression($current));
            }
        );
    }

    /**
     * @return Collection
     */
    public function flatten(): Collection
    {
        return $this->fold(
            new static(),
            function (Collection $accumulated, Collection $current): Collection {
                return $accumulated->merge($current);
            }
        );
    }

    /**
     * @param int $startAt
     * @param int $count
     *
     * @return Collection
     */
    public function slice(int $startAt, int $count): Collection
    {
        return new static(array_slice($this->content, $startAt, $count));
    }

    /**
     * @param int  $whichOne
     * @param bool $keep
     *
     * @return Collection
     */
    public function every(int $whichOne, bool $keep = true): Collection
    {
        return new static(array_filter($this->content, function ($key) use ($whichOne, $keep) {
            return (0 === ($key + 1) % $whichOne && $keep) || (0 !== ($key + 1) % $whichOne && !$keep);
        }, ARRAY_FILTER_USE_KEY));
    }

    /**
     * @return Collection
     */
    public function reversed(): Collection
    {
        return new static(array_reverse($this->content));
    }

    /**
     * @return Option
     */
    public function sum(): Option
    {
        return $this->count()
            ? new Some(array_sum($this->content))
            : new None();
    }

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function filter(Closure $expression): Collection
    {
        return new static(array_filter($this->content, $expression));
    }

    /**
     * @param Closure $expression
     *
     * @return Collection
     */
    public function filterNot(Closure $expression): Collection
    {
        return new static(array_filter($this->content, function ($item) use ($expression) {
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
        return new static(array_map(function ($item) {
            return new static($item);
        }, array_chunk($this->content, $chunkSize)));
    }

    /**
     * @param int $groupsCount
     *
     * @return Collection
     */
    public function groups(int $groupsCount): Collection
    {
        return new static(array_map(function ($item) {
            return new static($item);
        }, array_chunk($this->content, count($this->content) / $groupsCount)));
    }

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function diff(Collection $compareTo): Collection
    {
        return new static(array_merge(
            array_diff($this->content, $compareTo->toArray()),
            array_diff($compareTo->toArray(), $this->content)
        )
        );
    }

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function diffLeft(Collection $compareTo): Collection
    {
        return new static(array_diff($this->content, $compareTo->toArray()));
    }

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function diffRight(Collection $compareTo): Collection
    {
        return new static(array_diff($compareTo->toArray(), $this->content));
    }

    /**
     * @param Collection $compareTo
     *
     * @return Collection
     */
    public function intersection(Collection $compareTo): Collection
    {
        return new static(array_intersect($this->content, $compareTo->toArray()));
    }

    /**
     * @param Collection $with
     *
     * @return Collection
     */
    public function merge(Collection $with): Collection
    {
        return new static(array_merge($this->content, $with->toArray()));
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

        return new static($content);
    }

    /**
     * @param Closure $by
     *
     * @return Collection
     */
    public function sortBy(Closure $by): Collection
    {
        $content = $this->content;
        usort($content, function ($left, $right) use ($by) {
            return $by($left) > $by($right);
        });

        return new static($content);
    }

    /**
     * @return Collection
     */
    public function unique(): Collection
    {
        return new static(array_unique($this->content, SORT_REGULAR));
    }
}
