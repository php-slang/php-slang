<?php

namespace PhpSlang\Collection;

use Closure;
use PhpSlang\Exception\InvalidArgumentException;
use PhpSlang\Exception\NoContentException;
use PhpSlang\Option\None;
use PhpSlang\Option\Option;
use PhpSlang\Option\Some;

abstract class AbstractCollectionWithGetters extends AbstractCollectionWithContent
{
    public function get($index)
    {
        if (!is_int($index)) {
            throw new InvalidArgumentException('List index must be int');
        }
        if (!isset($this[$index])) {
            throw new NoContentException();
        }
        return $this->content[$index];
    }

    public function getOption($index) : Option
    {
        if (!is_int($index)) {
            throw new InvalidArgumentException('List index must be int');
        }
        return isset($index, $this->content) ? new Some($this->content[$index]) : new None();
    }

    public function head()
    {
        return $this->get(0);
    }

    public function headOption() : Option
    {
        return $this->getOption(0);
    }

    public function tail() : Collection
    {
        return $this->slice(1, $this->size() - 1);
    }

    public function every(int $whichOne, bool $keep = true) : Collection
    {
        return $this->filter(function ($value, $key) use ($whichOne, $keep) {
            return (($key + 1) % $whichOne === 0 && $keep) || (($key + 1) % $whichOne !== 0 && !$keep);
        });
    }

    public function last()
    {
        $last = array_pop($this->content);
        if (is_null($last)) {
            throw new NoContentException();
        }

        return $last;
    }

    public function lastOption() : Option
    {
        return Option::of(array_pop($this->content));
    }

    public function any(Closure $expression) : Option
    {
        foreach ($this->content as $item) {
            if ($expression($item)) {
                return new Some($item);
            }
        }
        return new None();
    }

    public function has(Closure $expression) : bool
    {
        return $this->any($expression)->isNotEmpty();
    }

    public function hasNot(Closure $expression) : bool
    {
        return $this->any($expression)->isEmpty();
    }

    public function hasValue($compareWith) : bool
    {
        foreach ($this->content as $item) {
            if ($compareWith == $item) {
                return true;
            }
        }
        return false;
    }

    public function hasNotValue($compareWith) : bool
    {
        foreach ($this->content as $item) {
            if ($compareWith == $item) {
                return false;
            }
        }
        return true;
    }

    public function indexOf(Closure $expression) : int
    {
        foreach ($this->content as $index => $item) {
            if ($expression($item)) {
                return $index;
            }
        }
        return -1;
    }

}