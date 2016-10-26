<?php

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get05
{
    use CollectionWithContent;

    public function _5()
    {
        return $this->content[4];
    }
}