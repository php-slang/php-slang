<?php

declare(strict_types=1);

namespace PhpSlang\Either;

use Closure;
use PhpSlang\Option\Option;

abstract class Either
{
    /**
     * @var mixed
     */
    protected $content;

    /**
     * @param Closure $expressionLeft
     * @param Closure $expressionRight
     *
     * @return mixed
     */
    abstract public function fold(Closure $expressionLeft, Closure $expressionRight);

    /**
     * @param Closure $expression
     *
     * @return Either
     */
    abstract public function left(Closure $expression): Either;

    /**
     * @param Closure $expression
     *
     * @return Either
     */
    abstract public function right(Closure $expression): Either;

    /**
     * @param Closure $expression
     *
     * @return Either
     */
    abstract public function flatLeft(Closure $expression): Either;

    /**
     * @param Closure $expression
     *
     * @return Either
     */
    abstract public function flatRight(Closure $expression): Either;

    /**
     * @return Option
     */
    abstract public function getLeftOption(): Option;

    /**
     * @return Option
     */
    abstract public function getRightOption(): Option;

    /**
     * @return bool
     */
    abstract public function isLeft(): bool;

    /**
     * @return bool
     */
    abstract public function isRight(): bool;

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->content;
    }
}
