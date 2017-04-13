<?php

declare(strict_types=1);

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get12
{
    use CollectionWithContent;

    /**
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    public function _12()
    {
        return $this->content[11];
    }
}
