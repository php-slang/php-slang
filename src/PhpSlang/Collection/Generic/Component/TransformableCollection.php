<?php

namespace PhpSlang\Collection\Generic\Component;

use PhpSlang\Collection\Generic\Collection;
use PhpSlang\Collection\HashMapCollection;
use PhpSlang\Collection\ListCollection;
use PhpSlang\Collection\SetCollection;

trait TransformableCollection
{
    use CollectionWithContent;

    final public function distinct() : Collection
    {
        return $this->unique();
    }

    final public function toArray() : array
    {
        return $this->content;
    }

    final public function toList() : ListCollection
    {
        return new ListCollection($this->content);
    }

    final public function toHashMap() : HashMapCollection
    {
        return new HashMapCollection($this->content);
    }

    final public function toSet() : SetCollection
    {
        return new SetCollection($this->content);
    }

}