<?php declare(strict_types=1);

namespace PhpSlang\Util\Trampoline;

class Done extends Trampoline
{
    /**
     * Done constructor.
     *
     * @param $result
     */
    public function __construct($result)
    {
        parent::__construct($result);
    }

    /**
     * @return Trampoline
     */
    public function run(): Trampoline
    {
        return new Done($this->content);
    }
}
