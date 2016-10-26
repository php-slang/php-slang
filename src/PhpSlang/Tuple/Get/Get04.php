<?php

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get04
{
    use CollectionWithContent;

    public function _4()
    {
        return $this->content[3];
    }
}