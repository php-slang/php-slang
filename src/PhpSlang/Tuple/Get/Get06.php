<?php

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get06
{
    use CollectionWithContent;

    public function _6()
    {
        return $this->content[5];
    }
}