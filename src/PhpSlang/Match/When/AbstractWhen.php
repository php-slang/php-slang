<?php

declare(strict_types=1);

namespace PhpSlang\Match\When;

use Closure;

abstract class AbstractWhen
{
    /**
     * @var mixed
     */
    protected $case;

    /**
     * @var mixed
     */
    protected $result;

    /**
     * AbstractWhen constructor.
     *
     * @param $case
     * @param $result
     */
    public function __construct($case, $result)
    {
        $this->case = $case;
        $this->result = $result;
    }

    /**
     * @param $subject
     *
     * @return bool
     */
    abstract public function matches($subject): bool;

    /**
     * @param $subject
     *
     * @return mixed
     */
    public function getResult($subject)
    {
        return $this->result instanceof Closure ? ($this->result)($subject) : $this->result;
    }
}
