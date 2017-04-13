<?php

declare(strict_types=1);

namespace PhpSlang\Tuple\Get;

use PhpSlang\Collection\Generic\Component\CollectionWithContent;

trait Get03
{
    use CollectionWithContent;

    /**
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    public function _3()
    {
        return $this->content[2];
    }
}
