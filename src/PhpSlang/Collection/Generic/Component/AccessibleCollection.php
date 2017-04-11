<?php

declare(strict_types=1);

namespace PhpSlang\Collection\Generic\Component;

use Closure;
use InvalidArgumentException;
use PhpSlang\Collection\Generic\Collection;
use PhpSlang\Exception\NoContentException;
use PhpSlang\Option\None;
use PhpSlang\Option\Option;
use PhpSlang\Option\Some;

trait AccessibleCollection
{
    use CollectionWithContent;

    /**
     * @param $index
     *
     * @return mixed
     * @throws NoContentException
     */
    final public function get($index)
    {
        if (!is_int($index)) {
            throw new InvalidArgumentException('List index must be int');
        }
        if (!array_key_exists($index, $this->content)) {
            throw new NoContentException();
        }
        return $this->content[$index];
    }

    /**
     * @return Option
     */
    final public function lastOption(): Option
    {
        return Option::of(array_pop($this->content));
    }

    /**
     * @param Closure $expression
     *
     * @return Option
     */
    final public function any(Closure $expression): Option
    {
        foreach ($this->content as $item) {
            if ($expression($item)) {
                return new Some($item);
            }
        }
        return new None();
    }

    /**
     * @return mixed
     */
    final public function first()
    {
        return $this->head();
    }

    /**
     * @return Option
     */
    final public function firstOption(): Option
    {
        return $this->headOption();
    }

    /**
     * @param $index
     *
     * @return Option
     */
    final public function getOption($index): Option
    {
        if (!is_int($index)) {
            throw new InvalidArgumentException('List index must be int');
        }
        return array_key_exists($index, $this->content) ? new Some($this->content[$index]) : new None();
    }

    /**
     * @return mixed
     */
    final public function head()
    {
        return $this->get(0);
    }

    /**
     * @return Option
     */
    final public function headOption(): Option
    {
        return $this->getOption(0);
    }

    /**
     * @return mixed
     * @throws NoContentException
     */
    final public function last()
    {
        $last = array_pop($this->content);
        if (is_null($last)) {
            throw new NoContentException();
        }

        return $last;
    }

    /**
     * @param Closure $expression
     *
     * @return int
     */
    final public function indexOf(Closure $expression): int
    {
        foreach ($this->content as $index => $item) {
            if ($expression($item)) {
                return $index;
            }
        }
        return -1;
    }

    /**
     * @return Collection
     */
    final public function tail(): Collection
    {
        return $this->slice(1, $this->size() - 1);
    }
}
