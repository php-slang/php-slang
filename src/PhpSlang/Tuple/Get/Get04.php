<?php declare(strict_types=1);

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get04
{
    use CollectionWithContent;

    /**
     * @return mixed
     */
    public function _4()
    {
        return $this->content[3];
    }
}