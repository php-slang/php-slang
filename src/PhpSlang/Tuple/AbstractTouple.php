<?php

namespace PhpSlang\Tuple;

use PhpSlang\Collection\Generic\AbstractCollection;
use PhpSlang\Exception\ImproperCollectionInputException;

class AbstractTouple extends AbstractCollection
{
    protected function validInput(array $array)
    {
        foreach ($array as $key => $item) {
            if (!is_numeric($key)) {
                throw new ImproperCollectionInputException(
                    'Immutable list can contain only linear data. Use HashMapCollection for storing key, value data.');
            }
        }
        return array_values($array);
    }

}