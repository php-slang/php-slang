<?php

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get08
{
    use CollectionWithContent;

    public function _8()
    {
        return $this->content[7];
    }
}