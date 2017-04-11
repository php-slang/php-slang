<?php

declare(strict_types=1);

namespace PhpSlang\Util\Trampoline;

use Closure;

class Bounce extends Trampoline
{
    /**
     * Bounce constructor.
     *
     * @param Closure $content
     */
    public function __construct(Closure $content)
    {
        parent::__construct($content);
    }

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
