<?php declare(strict_types=1);

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get08
{
    use CollectionWithContent;

    /**
     * @return mixed
     */
    public function _8()
    {
        return $this->content[7];
    }
}