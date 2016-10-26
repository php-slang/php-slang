<?php

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get10
{
    use CollectionWithContent;

    public function _10()
    {
        return $this->content[9];
    }
}