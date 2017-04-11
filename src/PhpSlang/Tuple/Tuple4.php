<?php

declare(strict_types=1);

namespace PhpSlang\Tuple;

use PhpSlang\Tuple\Get\Get01;
use PhpSlang\Tuple\Get\Get02;
use PhpSlang\Tuple\Get\Get03;
use PhpSlang\Tuple\Get\Get04;

class Tuple4 extends AbstractTuple
{
    use Get01;
    use Get02;
    use Get03;
    use Get04;

    /**
     * Tuple4 constructor.
     *
     * @param $it1
     * @param $it2
     * @param $it3
     * @param $it4
     */
    public function __construct($it1, $it2, $it3, $it4)
    {
        $this->content = $this->validInput([$it1, $it2, $it3, $it4]);
    }
}
