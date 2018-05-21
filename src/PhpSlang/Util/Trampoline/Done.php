<?php

declare(strict_types=1);

namespace PhpSlang\Util\Trampoline;

class Done extends Trampoline
{
    /**
     * @return Trampoline
     */
    public function run(): Trampoline
    {
        return new self($this->content);
    }
}
