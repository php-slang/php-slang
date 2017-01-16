<?php

namespace PhpSlang\Util\Trampoline;

class Done extends Trampoline
{
    public function __construct($result)
    {
        parent::__construct($result);
    }

    public function run(): Trampoline
    {
        return new Done($this->content);
    }
}
