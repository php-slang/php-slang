<?php

namespace PhpSlang\Match\When;

use Closure;

abstract class AbstractWhen
{
    protected $case;

    protected $result;

    public abstract function matches($subject) : bool;

    public function __construct($case, $result)
    {
        $this->case = $case;
        $this->result = $result;
    }

    public function getResult($subject)
    {
        return $this->result instanceof Closure ? ($this->result)($subject) : $this->result;
    }

}