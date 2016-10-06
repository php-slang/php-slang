<?php

namespace PhpSlang\Match\When;

use PhpSlang\Option\None;

class Other extends AbstractWhen
{
    public function __construct($result)
    {
        parent::__construct(new None(), $result);
    }

    public function matches($subject) : bool
    {
        return true;
    }
}
