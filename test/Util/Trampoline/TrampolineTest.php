<?php

declare(strict_types=1);

namespace PhpSlang\Util\Trampoline;

use Closure;
use PHPUnit\Framework\TestCase;

class TrampolineTest extends TestCase
{
    private function trampolinedFibonacci(int $index)
    {
        return (new Trampoline(function () use ($index) {
            return $this->tailRecursiveFibonacci($index);
        }))->run();
    }

    private function tailRecursiveFibonacci(int $index, int $previous = 0, int $next = 1)
    {
        return ($index <= 1)
            ? new Done($index == 0 ? $previous : $next)
            : new Bounce(function () use ($index, $next, $previous) {
                return $this->tailRecursiveFibonacci($index - 1, $next, $next + $previous);
            });
    }

    public function testFibonacci()
    {
        $this->assertEquals(0, $this->trampolinedFibonacci(0));
        $this->assertEquals(1, $this->trampolinedFibonacci(1));
        $this->assertEquals(1, $this->trampolinedFibonacci(2));
        $this->assertEquals(2, $this->trampolinedFibonacci(3));
        $this->assertEquals(3, $this->trampolinedFibonacci(4));
        $this->assertEquals(5, $this->trampolinedFibonacci(5));
        $this->assertEquals(8, $this->trampolinedFibonacci(6));
        $this->assertEquals(13, $this->trampolinedFibonacci(7));
        $this->assertEquals(21, $this->trampolinedFibonacci(8));
        $this->assertEquals(34, $this->trampolinedFibonacci(9));
        $this->assertEquals(55, $this->trampolinedFibonacci(10));
    }

    public function testDone()
    {
        $this->assertInstanceOf(Done::class, $this->tailRecursiveFibonacci(0));
        $this->assertInstanceOf(Done::class, $this->tailRecursiveFibonacci(0)->run());
        $this->assertEquals(0, $this->tailRecursiveFibonacci(0)->get());
        $this->assertEquals(0, $this->tailRecursiveFibonacci(0)->run()->get());
    }

    public function testBounce()
    {
        $this->assertInstanceOf(Bounce::class, $this->tailRecursiveFibonacci(4));
        $this->assertInstanceOf(Bounce::class, $this->tailRecursiveFibonacci(4)->run());
        $this->assertInstanceOf(Bounce::class, $this->tailRecursiveFibonacci(4)->run()->run());
        $this->assertInstanceOf(Closure::class, $this->tailRecursiveFibonacci(4)->run()->get());
    }
}
