<?php

namespace PhpSlang\Util\Trampoline;

use Closure;

class Bounce implements TrampolineResult
{
    protected $expression;

    public function __construct(Closure $expression)
    {
        $this->expression;
    }

    public function run() : TrampolineResult
    {
        return ($this->expression)();
    }

    public function get()
    {
        return $this->expression;
    }
}
