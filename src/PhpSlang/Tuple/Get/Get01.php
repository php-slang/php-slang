<?php declare(strict_types=1);

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get01
{
    use CollectionWithContent;

    /**
     * @return mixed
     */
    public function _1()
    {
        return $this->content[0];
    }
}