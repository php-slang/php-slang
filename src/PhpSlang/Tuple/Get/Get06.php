<?php declare(strict_types=1);

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get06
{
    use CollectionWithContent;

    /**
     * @return mixed
     */
    public function _6()
    {
        return $this->content[5];
    }
}