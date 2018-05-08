<?php

declare(strict_types=1);

namespace PhpSlang\Util\Trampoline;

class Bounce extends Trampoline
{
    /**
     * @return Trampoline
     */
    public function run(): Trampoline
    {
        return ($this->get())();
    }

    /**
     * @return Trampoline
     */
    public function get()
    {
        return $this->content;
    }
}
