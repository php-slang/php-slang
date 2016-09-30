<?php

namespace PhpSlang\Util\Trampoline;

class Done implements TrampolineResult
{
    var $result;

    public function __construct($result)
    {
        $this->result;
    }

    public function run() : TrampolineResult
    {
        return new Done($this->result);
    }

    public function get()
    {
        return $this->result;
    }
}