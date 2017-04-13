<?php

declare(strict_types=1);

namespace PhpSlang\Option;

use Closure;

abstract class Option
{
    /**
     * @param      $content
     * @param null $empty
     *
     * @return None|Some
     */
    final public static function of($content, $empty = null)
    {
        return ($content == $empty) ? new None() : new Some($content);
    }

    /**
     * @param Closure $expression
     *
     * @return Option
     */
    abstract public function map(Closure $expression): Option;

    /**
     * @param Closure $expression
     *
     * @return Option
     */
    abstract public function flatMap(Closure $expression): Option;

    /**
     * @return mixed
     */
    abstract public function get();

    /**
     * @param $default
     *
     * @return mixed
     */
    abstract public function getOrElse($default);

    /**
     * @param Closure $defaultExpression
     *
     * @return mixed
     */
    abstract public function getOrCall(Closure $defaultExpression);

    /**
     * @return bool
     */
    abstract public function isEmpty(): bool;

    /**
     * @return bool
     */
    abstract public function isNotEmpty(): bool;
}
