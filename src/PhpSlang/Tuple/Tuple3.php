<?php

namespace PhpSlang\Tuple;

use PhpSlang\Collection\ListCollection;
use PhpSlang\Tuple\Get\Get01;
use PhpSlang\Tuple\Get\Get02;
use PhpSlang\Tuple\Get\Get03;

class Tuple3 extends ListCollection
{
    use Get01;
    use Get02;
    use Get03;

    public function __construct($it1, $it2, $it3)
    {
        parent::__construct([$it1, $it2, $it3]);
    }
}