<?php declare(strict_types=1);

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
    /**
     * @param $case
     * @param $result
     *
     * @return TypeOf
     */
    public static function typeOf($case, $result): TypeOf
    {
        return new TypeOf($case, $result);
    }

    /**
     * @param $case
     * @param $result
     *
     * @return Equals
     */
    public static function equals($case, $result): Equals
    {
        return new Equals($case, $result);
    }

    /**
     * @param Closure $case
     * @param         $result
     *
     * @return Results
     */
    public static function results(Closure $case, $result): Results
    {
        return new Results($case, $result);
    }

    /**
     * @param $result
     *
     * @return Other
     */
    public static function other($result): Other
    {
        return new Other($result);
    }

    /**
     * @param $subject
     *
     * @return bool
     */
    public function matches($subject): bool
    {
        return (new ListCollection([
            Option::of($this->case instanceof Closure, false)
                ->map(function () {
                    return new Results($this->case, $this->result);
                }),
            Option::of(is_string($this->case) && class_exists($this->case), false)
                ->map(function () {
                    return new TypeOf($this->case, $this->result);
                }),
            new Some(new Equals($this->case, $this->result)),
        ]))
            ->filter(function (Option $opt) {
                return $opt->isNotEmpty();
            })
            ->map(function (Option $opt) {
                return $opt->get();
            })
            ->any(function (AbstractWhen $when) use ($subject) {
                return $when->matches($subject);
            })
            ->map(function (AbstractWhen $when) use ($subject) {
                return $when->matches($subject);
            })
            ->getOrElse(false);
    }
}
