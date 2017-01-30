<?php

namespace PhpSlang\Match\When;

use PhpSlang\Option\None;

class Other extends AbstractWhen
{
    /**
     * Other constructor.
     *
     * @param $result
     */
    public function __construct($result)
    {
        parent::__construct(new None(), $result);
    }

    /**
     * @param $subject
     *
     * @return bool
     */
    public function matches($subject): bool
    {
        return true;
    }
}
