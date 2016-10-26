<?php

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get11
{
    use CollectionWithContent;

    public function _11()
    {
        return $this->content[10];
    }
}