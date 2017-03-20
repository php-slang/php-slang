<?php declare(strict_types=1);

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get11
{
    use CollectionWithContent;

    /**
     * @return mixed
     */
    public function _11()
    {
        return $this->content[10];
    }
}