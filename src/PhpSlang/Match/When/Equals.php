<?php

namespace PhpSlang\Match\When;

class Equals extends AbstractWhen
{
    public function matches($subject) : bool
    {
        return $this->case == $subject;
    }
}