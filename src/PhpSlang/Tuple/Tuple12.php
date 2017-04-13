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
use PhpSlang\Tuple\Get\Get08;
use PhpSlang\Tuple\Get\Get09;
use PhpSlang\Tuple\Get\Get10;
use PhpSlang\Tuple\Get\Get11;
use PhpSlang\Tuple\Get\Get12;

class Tuple12 extends AbstractTuple
{
    use Get01;
    use Get02;
    use Get03;
    use Get04;
    use Get05;
    use Get06;
    use Get07;
    use Get08;
    use Get09;
    use Get10;
    use Get11;
    use Get12;

    /**
     * Tuple12 constructor.
     *
     * @param $it1
     * @param $it2
     * @param $it3
     * @param $it4
     * @param $it5
     * @param $it6
     * @param $it7
     * @param $it8
     * @param $it9
     * @param $it10
     * @param $it11
     * @param $it12
     */
    public function __construct($it1, $it2, $it3, $it4, $it5, $it6, $it7, $it8, $it9, $it10, $it11, $it12)
    {
        $this->content = $this->validInput([$it1, $it2, $it3, $it4, $it5, $it6, $it7, $it8, $it9, $it10, $it11, $it12]);
    }
}
