<?php

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get03
{
    use CollectionWithContent;

    /**
     * @return mixed
     */
    public function _3()
    {
        return $this->content[2];
    }
}