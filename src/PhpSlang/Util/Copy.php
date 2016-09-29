<?php

namespace PhpSlang\Util;

trait Copy
{
    final public function copy($name, $value)
    {
        $clone = clone $this;
        $clone->$name = $value;

        return $clone;
    }
}