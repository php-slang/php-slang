<?php

namespace PhpSlang\Collection\Generic;

use PhpSlang\Collection\Generic\Component\AccessibleCollection;
use PhpSlang\Collection\Generic\Component\ExaminableCollection;
use PhpSlang\Collection\Generic\Component\FoldableCollection;
use PhpSlang\Collection\Generic\Component\PartitionableCollection;
use PhpSlang\Collection\Generic\Component\TransformableCollection;

abstract class AbstractCollection implements Collection
{
    use AccessibleCollection;
    use ExaminableCollection;
    use FoldableCollection;
    use PartitionableCollection;
    use TransformableCollection;
}
