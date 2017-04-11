<?php

declare(strict_types=1);

namespace PhpSlang\Option;

use Closure;
use PhpSlang\Exception\NoContentException;

class None extends Option
{
    /**
     * None constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param Closure $expression
     *
     * @return Option
     */
    final public function map(Closure $expression): Option
    {
        return new None();
    }

    /**
     * @param Closure $expression
     *
     * @return Option
     */
    final public function flatMap(Closure $expression): Option
    {
        return new None();
    }

    /**
     * @throws NoContentException
     */
    final public function get()
    {
        throw new NoContentException();
    }

    /**
     * @param $default
     *
     * @return mixed
     */
    final public function getOrElse($default)
    {
        return $default;
    }

    /**
     * @param Closure $defaultExpression
     *
     * @return mixed
     */
    final public function getOrCall(Closure $defaultExpression)
    {
        return $defaultExpression();
    }

    /**
     * @return bool
     */
    final public function isEmpty(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    final public function isNotEmpty(): bool
    {
        return false;
    }
}
