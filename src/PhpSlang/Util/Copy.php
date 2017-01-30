<?php

namespace PhpSlang\Util;

trait Copy
{
    /**
     * @param string $name
     * @param        $value
     *
     * @return Copy
     */
    final public function copy(string $name, $value)
    {
        $clone = clone $this;
        $clone->$name = $value;

        return $clone;
    }
}
