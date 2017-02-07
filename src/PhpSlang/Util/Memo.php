<?php

namespace PhpSlang\Util;

use Closure;

class Memo
{
    /**
     * @var array
     */
    private $cache;

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
    private function isCached(string $parametersHash): bool
    {
        return isset($this->cache[$parametersHash]);
    }

    /**
     * @param string $parametersHash
     *
     * @return mixed
     */
    private function getCached(string $parametersHash)
    {
        return $this->cache[$parametersHash];
    }

    /**
     * @param string  $parametersHash
     * @param Closure $expression
     * @param array   $args
     *
     * @return mixed
     */
    private function setCache(string $parametersHash, Closure $expression, array $args)
    {
        $this->cache[$parametersHash] = call_user_func_array($expression, $args);

        return $this->getCached($parametersHash);
    }
}
