<?php

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get01
{
    use CollectionWithContent;

    public function _1()
    {
        return $this->content[0];
    }
}