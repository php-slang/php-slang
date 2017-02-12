<?php

namespace PhpSlang\Memoisation;

use Closure;

/**
 * In memory cache Memo implementation
 */
class Memo extends AbstractMemo
{
    /**
     * @var array
     */
    private $cache;

    /**
     * {@inheritdoc}
     */
    protected function isCached(string $parametersHash): bool
    {
        return isset($this->cache[$parametersHash]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getCached(string $parametersHash)
    {
        return $this->cache[$parametersHash];
    }

    /**
     * {@inheritdoc}
     */
    protected function setCache(string $parametersHash, Closure $expression, array $args)
    {
        $this->cache[$parametersHash] = $expression(...$args);

        return $this->getCached($parametersHash);
    }
}
