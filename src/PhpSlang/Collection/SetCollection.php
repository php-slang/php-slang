<?php declare(strict_types = 1);

namespace PhpSlang\Collection;

use Closure;
use PhpSlang\Collection\Generic\AbstractCollection;
use PhpSlang\Collection\Generic\Collection;
use PhpSlang\Exception\ImproperCollectionInputException;

class SetCollection extends AbstractCollection
{
    /**
     * SetCollection constructor.
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
                    'Immutable set can contain only linear data. Use HashMapCollection for storing key, value data.'
                );
            }
        }
        $this->content = array_unique(array_values($array), SORT_REGULAR);
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
        return new HashMapCollection(array_flip($this->content));
    }

    /**
     * @return SetCollection
     */
    public function toSet(): SetCollection
    {
        return new SetCollection($this->content);
    }
}
