<?php

declare(strict_types=1);

namespace PhpSlang\Option;

use Closure;
use TypeError;

class Some extends Option
{
    /**
     * @var
     */
    protected $content;

    /**
     * Some constructor.
     *
     * @param $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @param Closure $expression
     *
     * @return Option
     */
    final public function map(Closure $expression): Option
    {
        return new Some($expression($this->content));
    }

    /**
     * @param Closure $expression
     *
     * @return Option
     * @throws TypeError
     */
    final public function flatMap(Closure $expression): Option
    {
        $result = $expression($this->content);
        if (!$result instanceof Option) {
            throw new TypeError("Closure passed to flatMap must return Option.");
        }

        return $result;
    }

    /**
     * @return mixed
     */
    final public function get()
    {
        return $this->content;
    }

    /**
     * @param $default
     *
     * @return mixed
     */
    final public function getOrElse($default)
    {
        return $this->content;
    }

    /**
     * @param Closure $defaultExpression
     *
     * @return mixed
     */
    final public function getOrCall(Closure $defaultExpression)
    {
        return $this->content;
    }

    /**
     * @return bool
     */
    final public function isEmpty(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    final public function isNotEmpty(): bool
    {
        return true;
    }
}
