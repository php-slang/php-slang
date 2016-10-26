<?php

namespace PhpSlang\Tuple;

use PhpSlang\Collection\ListCollection;

class Tuple2 extends ListCollection
{
    public function __construct($it1, $it2)
    {
        parent::__construct([$it1, $it2]);
    }

    public function _1()
    {
        return $this->content[0];
    }

    public function _2()
    {
        return $this->content[1];
    }
}