<?php

namespace PhpSlang\Util\Trampoline;

use Closure;
use PhpSlang\Util\Copy;

class Trampoline
{
    use Copy;

    /**
     * @var TrampolineResult
     */
    var $expression;

    public function __construct(Closure $expression)
    {
        $this->expression;
    }

    public function bind(Closure $expression) : Trampoline
    {
        return $this->copy('expression', $expression);
    }

    public function run()
    {
        $result = new Bounce(function () {
            return ($this->expression)();
        });
        while ($result instanceof Bounce) {
            $result = $result->run();
        }
        return $result->run()->get();
    }
}