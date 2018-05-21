<?php

declare(strict_types=1);

namespace PhpSlang\Either;

use Closure;
use PhpSlang\Option\None;
use PhpSlang\Option\Option;
use PhpSlang\Option\Some;

class Left extends Either
{
    /**
     * Left constructor.
     *
     * @param $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @param Closure $expressionLeft
     * @param Closure $expressionRight
     *
     * @return mixed
     */
    public function fold(Closure $expressionLeft, Closure $expressionRight)
    {
        return $this->left($expressionLeft)->get();
    }

    /**
     * @param Closure $expression
     *
     * @return Either
     */
    public function left(Closure $expression): Either
    {
        return new self($expression($this->get()));
    }

    /**
     * @param Closure $expression
     *
     * @return Either
     */
    public function right(Closure $expression): Either
    {
        return new self($this->get());
    }

    /**
     * @return Option
     */
    public function getLeftOption(): Option
    {
        return new Some($this->get());
    }

    /**
     * @return Option
     */
    public function getRightOption(): Option
    {
        return new None();
    }

    /**
     * @param Closure $expression
     *
     * @return Either
     */
    public function flatLeft(Closure $expression): Either
    {
        return $expression($this->get());
    }

    /**
     * @param Closure $expression
     *
     * @return Either
     */
    public function flatRight(Closure $expression): Either
    {
        return new self($this->get());
    }

    /**
     * @return bool
     */
    public function isLeft(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isRight(): bool
    {
        return false;
    }
}
