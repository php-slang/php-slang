<?php

namespace PhpSlang\Collection\Generic\Component;

trait IterableCollection
{
    use CollectionWithContent;

    public function rewind()
    {
        reset($this->content);
    }

    public function key()
    {
        return key($this->content);
    }

    public function current()
    {
        return current($this->content);
    }

    public function next()
    {
        return next($this->content);
    }

    public function valid()
    {
        return $this->key() !== null;
    }
}
