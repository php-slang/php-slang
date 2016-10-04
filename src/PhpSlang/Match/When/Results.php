<?php

namespace PhpSlang\Match\When;

class Results extends AbstractWhen
{
    public function matches($subject) : bool
    {
        return ($this->case)($subject);
    }
}