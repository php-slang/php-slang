<?php

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get12
{
    use CollectionWithContent;

    public function _12()
    {
        return $this->content[11];
    }
}