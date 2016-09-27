<?php

namespace PhpSlang\Util;

use PhpSlang\Exception\ReassignmentException;

trait Copy
{
    final public function copy($name, $value)
    {
        $clone = clone $this;
        $clone->$name = $value;

        return $clone;
    }
}