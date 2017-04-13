<?php

declare(strict_types=1);

namespace PhpSlang\Tuple;

use PhpSlang\Collection\Generic\AbstractCollection;
use PhpSlang\Collection\HashMapCollection;
use PhpSlang\Collection\ListCollection;
use PhpSlang\Collection\SetCollection;

class AbstractTuple extends AbstractCollection
{
    protected function validInput(array $array)
    {
        return array_values($array);
    }

    /**
     * @return ListCollection
     */
    public function toList(): ListCollection
    {
        return new ListCollection($this->content);
    }

    /**
     * @return HashMapCollection
     */
    public function toHashMap(): HashMapCollection
    {
        return new HashMapCollection($this->content);
    }

    /**
     * @return SetCollection
     */
    public function toSet(): SetCollection
    {
        return new SetCollection($this->content);
    }
}
