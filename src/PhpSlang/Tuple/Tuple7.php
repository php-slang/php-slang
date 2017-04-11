<?php

declare(strict_types=1);

namespace PhpSlang\Tuple;

use PhpSlang\Tuple\Get\Get01;
use PhpSlang\Tuple\Get\Get02;
use PhpSlang\Tuple\Get\Get03;
use PhpSlang\Tuple\Get\Get04;
use PhpSlang\Tuple\Get\Get05;
use PhpSlang\Tuple\Get\Get06;
use PhpSlang\Tuple\Get\Get07;

class Tuple7 extends AbstractTuple
{
    use Get01;
    use Get02;
    use Get03;
    use Get04;
    use Get05;
    use Get06;
    use Get07;

    /**
     * Tuple7 constructor.
     *
     * @param $it1
     * @param $it2
     * @param $it3
     * @param $it4
     * @param $it5
     * @param $it6
     * @param $it7
     */
    public function __construct($it1, $it2, $it3, $it4, $it5, $it6, $it7)
    {
        $this->content = $this->validInput([$it1, $it2, $it3, $it4, $it5, $it6, $it7]);
    }
}
