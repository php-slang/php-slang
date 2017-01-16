<?php

namespace PhpSlang\Match;

use Closure;
use PhpSlang\Collection\ListCollection;
use PhpSlang\Match\When\AbstractWhen;
use PhpSlang\Match\When\Equals;
use PhpSlang\Match\When\Other;
use PhpSlang\Match\When\Results;
use PhpSlang\Match\When\TypeOf;
use PhpSlang\Option\Option;
use PhpSlang\Option\Some;

class When extends AbstractWhen
{
    public static function typeOf($case, $result): TypeOf
    {
        return new TypeOf($case, $result);
    }

    public static function equals($case, $result): Equals
    {
        return new Equals($case, $result);
    }

    public static function results(Closure $case, $result): Results
    {
        return new Results($case, $result);
    }

    public static function other($result): Other
    {
        return new Other($result);
    }

    public function matches($subject): bool
    {
        return (new ListCollection([
            Option::of($this->case instanceof Closure, false)
                ->map(function () {
                    return new Results($this->case, $this->result);
                }),
            Option::of(class_exists($this->case), false)
                ->map(function () {
                    return new TypeOf($this->case, $this->result);
                }),
            new Some(new Equals($this->case, $this->result)),
        ]))
            ->filter(function (Option $opt) {
                return $opt->isNotEmpty();
            })
            ->any(function (AbstractWhen $when) use ($subject) {
                return $when->matches($subject);
            })
            ->getOrElse(false);
    }
}
