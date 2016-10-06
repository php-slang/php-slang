<?php
namespace PhpSlang\Match\When;

class TypeOf extends AbstractWhen
{
    public function matches($subject) : bool
    {
        return $subject instanceof $this->case;
    }
}
