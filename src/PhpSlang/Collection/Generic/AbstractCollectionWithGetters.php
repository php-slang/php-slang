<?php

namespace PhpSlang\Collection\Generic;

use Closure;
use PhpSlang\Exception\InvalidArgumentException;
use PhpSlang\Exception\NoContentException;
use PhpSlang\Option\None;
use PhpSlang\Option\Option;
use PhpSlang\Option\Some;

abstract class AbstractCollectionWithGetters extends AbstractCollectionWithContent
{
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

    final public function getOption($index) : Option
    {
        if (!is_int($index)) {
            throw new InvalidArgumentException('List index must be int');
        }
        return array_key_exists($index, $this->content) ? new Some($this->content[$index]) : new None();
    }

    final public function head()
    {
        return $this->get(0);
    }

    final public function headOption() : Option
    {
        return $this->getOption(0);
    }

    final public function tail() : Collection
    {
        return $this->slice(1, $this->size() - 1);
    }

    final public function last()
    {
        $last = array_pop($this->content);
        if (is_null($last)) {
            throw new NoContentException();
        }

        return $last;
    }

    final public function lastOption() : Option
    {
        return Option::of(array_pop($this->content));
    }

    final public function any(Closure $expression) : Option
    {
        foreach ($this->content as $item) {
            if ($expression($item)) {
                return new Some($item);
            }
        }
        return new None();
    }

    final public function has(Closure $expression) : bool
    {
        return $this->any($expression)->isNotEmpty();
    }

    final public function hasNot(Closure $expression) : bool
    {
        return $this->any($expression)->isEmpty();
    }

    final public function hasValue($compareWith) : bool
    {
        foreach ($this->content as $item) {
            if ($compareWith == $item) {
                return true;
            }
        }
        return false;
    }

    final public function hasNotValue($compareWith) : bool
    {
        foreach ($this->content as $item) {
            if ($compareWith == $item) {
                return false;
            }
        }
        return true;
    }

    final public function indexOf(Closure $expression) : int
    {
        foreach ($this->content as $index => $item) {
            if ($expression($item)) {
                return $index;
            }
        }
        return -1;
    }

}