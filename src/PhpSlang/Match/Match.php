<?php

namespace PhpSlang\Match;

use PhpSlang\Collection\ListCollection;
use PhpSlang\Exception\NoMatchFoundException;
use PhpSlang\Match\When\AbstractWhen;

class Match
{
    var $matched;

    public function __construct($matched)
    {
        $this->matched = $matched;
    }

    public function of(...$cases)
    {
        return (new ListCollection($cases))
            ->any(function (AbstractWhen $case) {
                return $case->matches($this->matched);
            })
            ->map(function (When $case) {
                return $case->getResult($this->matched);
            })
            ->getOrCall(function () {
                throw new NoMatchFoundException();
            });
    }
}