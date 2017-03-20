<?php declare(strict_types=1);

namespace PhpSlang\Match\When;

class Equals extends AbstractWhen
{
    /**
     * @param $subject
     *
     * @return bool
     */
    public function matches($subject): bool
    {
        return $this->case == $subject;
    }
}
