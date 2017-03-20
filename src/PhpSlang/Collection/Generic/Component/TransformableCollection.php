<?php declare(strict_types=1);

namespace PhpSlang\Collection\Generic\Component;

use PhpSlang\Collection\Generic\Collection;
use PhpSlang\Collection\HashMapCollection;
use PhpSlang\Collection\ListCollection;
use PhpSlang\Collection\SetCollection;

trait TransformableCollection
{
    use CollectionWithContent;

    /**
     * @return Collection
     */
    final public function distinct(): Collection
    {
        return $this->unique();
    }

    /**
     * @return array
     */
    final public function toArray(): array
    {
        return $this->content;
    }
}