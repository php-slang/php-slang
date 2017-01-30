<?php

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get10
{
    use CollectionWithContent;

    /**
     * @return mixed
     */
    public function _10()
    {
        return $this->content[9];
    }
}