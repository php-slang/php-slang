<?php

namespace PhpSlang\Memoisation;

use Closure;

abstract class AbstractMemo
{
    /**
     * @param Closure $expression
     *
     * @return Closure
     */
    public function memoize(Closure $expression): Closure
    {
        return function () use ($expression) {
            $args = func_get_args();
            $parametersHash = md5(serialize($args));
            return $this->isCached($parametersHash)
                ? $this->getCached($parametersHash)
                : $this->setCache($parametersHash, $expression, $args);
        };
    }

    /**
     * @param string $parametersHash
     *
     * @return bool
     */
    abstract protected function isCached(string $parametersHash): bool;

    /**
     * @param string $parametersHash
     *
     * @return mixed
     */
    abstract protected function getCached(string $parametersHash);

    /**
     * @param string  $parametersHash
     * @param Closure $expression
     * @param array   $args
     *
     * @return mixed
     */
    abstract protected function setCache(string $parametersHash, Closure $expression, array $args);
}