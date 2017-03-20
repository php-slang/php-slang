<?php declare(strict_types=1);

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
        foreach ($array as $key => $item) {
            if (!is_numeric($key)) {
                throw new ImproperCollectionInputException(
                    'Immutable list can contain only linear data. Use HashMapCollection for storing key, value data.');
            }
        }
        $this->content = array_values($array);
    }
}
