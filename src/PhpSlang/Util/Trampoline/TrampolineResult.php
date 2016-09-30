<?php

namespace PhpSlang\Util\Trampoline;

interface TrampolineResult
{
    public function run() : TrampolineResult;

    public function get();
}