<?php

namespace PhpSlang\Tuple;

use PhpSlang\Collection\ListCollection;
use PhpSlang\Tuple\Get\Get01;
use PhpSlang\Tuple\Get\Get02;

class Tuple2 extends ListCollection
{
    use Get01;
    use Get02;

    /**
     * Tuple2 constructor.
     *
     * @param $it1
     * @param $it2
     */
    public function __construct($it1, $it2)
    {
        parent::__construct([$it1, $it2]);
    }
}