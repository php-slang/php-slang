<?php

declare(strict_types=1);

namespace PhpSlang\Collection;

use PhpSlang\Collection\Generic\AbstractCollection;
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
        foreach (array_keys($array) as $key) {
            if (!is_numeric($key)) {
                throw new ImproperCollectionInputException(
                    'Immutable list can contain only linear data. Use HashMapCollection for storing key, value data.'
                );
            }
        }
        $this->content = array_values($array);
    }

    /**
     * @return ListCollection
     */
    public function toList(): self
    {
        return new self($this->content);
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
