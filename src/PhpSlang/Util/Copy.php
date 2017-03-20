<?php declare(strict_types=1);

namespace PhpSlang\Util;

trait Copy
{
    /**
     * @param string $name
     * @param        $value
     *
     * @return static
     */
    final public function copy(string $name, $value)
    {
        $clone = clone $this;
        $clone->$name = $value;

        return $clone;
    }
}
