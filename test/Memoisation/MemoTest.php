<?php

namespace PhpSlang\Memoisation;

use Closure;
use PHPUnit_Framework_TestCase;

class ExampleMemoization
{
    /**
     * @var Closure
     */
    protected $memorizedCall1;

    /**
     * @var Closure
     */
    protected $memorizedCall2;

    /**
     * @var
     */
    public $opsCount1 = 0;

    /**
     * @var
     */
    public $opsCount2 = 0;

    public function __construct()
    {
        $this->memorizedCall1 = (new Memo)->memoize(function ($a, $b) {
            /*
             * Few words of explanation.
             *
             * This method modifies a state of a field opsCount1 (and memoizedCall2 does the same for opsCount2)
             * PhpSlang exists to allow PHP developers to
             * write functional code and it always should be: IMMUTABLE!
             *
             * In this case it's not and the only reason was to tests if memoized calls are executed just once.
             * Other option to check if a method is executed just once might be using sleep inside call and then
             * measuring a time of execution but it would make tests needlessly slow, so $opsCount seems
             * like a good compromise to test memoization properly in a rational amount of time.
             */
            $this->opsCount1++;
            return $a + $b;
        });

        $this->memorizedCall2 = (new Memo)->memoize(function ($a, $b) {
            $this->opsCount2++;
            return $a * $b;
        });
    }

    /**
     * @param int $a
     * @param int $b
     *
     * @return int
     */
    public function getMemorized1(int $a, int $b): int
    {
        return ($this->memorizedCall1)($a, $b);
    }

    /**
     * @param int $a
     * @param int $b
     *
     * @return int
     */
    public function getMemorized2(int $a, int $b): int
    {
        return ($this->memorizedCall2)($a, $b);
    }
}

class MemoTest extends PHPUnit_Framework_TestCase
{
    public function testMemorizedConstructor()
    {
        $this->assertInstanceOf(ExampleMemoization::class, new ExampleMemoization());
    }

    public function testMemorizedCalls()
    {
        $example = new ExampleMemoization();

        $result1 = $example->getMemorized1(5, 7);
        $this->assertEquals(12, $result1);
        $this->assertEquals(1, $example->opsCount1);

        $result2 = $example->getMemorized1(5, 7);
        $this->assertEquals(12, $result2);
        $this->assertEquals(1, $example->opsCount1);

        $result3 = $example->getMemorized2(5, 7);
        $this->assertEquals(35, $result3);
        $this->assertEquals(1, $example->opsCount2);

        $result4 = $example->getMemorized2(5, 7);
        $this->assertEquals(35, $result4);
        $this->assertEquals(1, $example->opsCount2);

        $result5 = $example->getMemorized1(5, 7);
        $this->assertEquals(12, $result5);
        $this->assertEquals(1, $example->opsCount1);
    }

}
