<?php declare(strict_types=1);

namespace PhpSlang\Collection;

use PhpSlang\Collection\Generic\AbstractCollection;
use PhpSlang\Collection\Generic\Collection;

class SetCollection extends AbstractCollection
{
    /**
     * SetCollection constructor.
     *
     * @param array $array
     */
    public function __construct(array $array = [])
    {
        $this->content = array_combine($array, array_fill(0, count($array), null));
    }

    /**
     * @param Collection $with
     *
     * @return Collection
     */
    public function merge(Collection $with): Collection
    {
        return new SetCollection(array_keys($this->content) + array_keys($with->toArray()));
    }
}
