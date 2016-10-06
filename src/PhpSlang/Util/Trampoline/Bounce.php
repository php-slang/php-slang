<?php

namespace PhpSlang\Util\Trampoline;

use Closure;

class Bounce extends Trampoline
{
    public function __construct(Closure $content)
    {
        parent::__construct($content);
    }

    public function run() : Trampoline
    {
        return ($this->get())();
    }

    public function get()
    {
        return $this->content;
    }
}
