<?php

declare(strict_types=1);

namespace PhpSlang\Either;

use PhpSlang\Option\None;
use PhpSlang\Option\Some;
use PHPUnit\Framework\TestCase;

class EitherTest extends TestCase
{
    public function testIsLeft()
    {
        $this->assertTrue((new Left(1))->isLeft());
        $this->assertFalse((new Right(1))->isLeft());
    }

    public function testIsRight()
    {
        $this->assertTrue((new Right(1))->isRight());
        $this->assertFalse((new Left(1))->isRight());
    }

    public function testLeftMap()
    {
        $this->assertInstanceOf(Left::class, (new Left(1))->left(function ($e) {
            return $e;
        }));

        $this->assertInstanceOf(Left::class, (new Left(1))->right(function ($e) {
            return $e;
        }));

        $this->assertEquals(2, (new Left(1))
            ->left(function ($e) {
                return $e * 2;
            })
            ->get());

        $this->assertNotEquals(2, (new Left(1))
            ->right(function ($e) {
                return $e * 2;
            })
            ->get());
    }

    public function testRightMap()
    {
        $this->assertInstanceOf(Right::class, (new Right(1))->left(function ($e) {
            return $e;
        }));

        $this->assertInstanceOf(Right::class, (new Right(1))->right(function ($e) {
            return $e;
        }));

        $this->assertNotEquals(2, (new Right(1))
            ->left(function ($e) {
                return $e * 2;
            })
            ->get());

        $this->assertEquals(2, (new Right(1))
            ->right(function ($e) {
                return $e * 2;
            })
            ->get());
    }

    public function testFoldForLeft()
    {
        $this->assertEquals(1, (new Left(1))
            ->fold(
                function ($leftArg) {
                    return $leftArg;
                },
                function ($rightArg) {
                    return $rightArg * 2;
                }
            ));

        $this->assertEquals(2, (new Left(1))
            ->fold(
                function ($leftArg) {
                    return $leftArg * 2;
                },
                function ($rightArg) {
                    return $rightArg;
                }
            ));
    }

    public function testFoldForRight()
    {
        $this->assertEquals(1, (new Right(1))
            ->fold(
                function ($leftArg) {
                    return $leftArg * 2;
                },
                function ($rightArg) {
                    return $rightArg;
                }
            ));

        $this->assertEquals(2, (new Right(1))
            ->fold(
                function ($leftArg) {
                    return $leftArg;
                },
                function ($rightArg) {
                    return $rightArg * 2;
                }
            ));
    }

    public function testFlatLeft()
    {
        $this->assertInstanceOf(Left::class, (new Left(new Left(1)))
            ->flatLeft(function ($e) {
                return $e;
            })
            ->flatRight(function ($e) {
                return $e;
            })
        );

        $this->assertEquals(1, (new Left(new Right(1)))
            ->flatLeft(function ($e) {
                return $e;
            })
            ->right(function ($e) {
                return $e;
            })
            ->get()
        );
    }

    public function testFlatRight()
    {
        $this->assertInstanceOf(Left::class, (new Right(new Left(1)))
            ->flatLeft(function ($e) {
                return $e;
            })
            ->flatRight(function ($e) {
                return $e;
            })
        );

        $this->assertEquals(1, (new Right(new Right(1)))
            ->flatRight(function ($e) {
                return $e;
            })
            ->right(function ($e) {
                return $e;
            })
            ->get()
        );
    }

    public function testLeftOption()
    {
        $this->assertInstanceOf(Some::class, (new Left(1))
            ->left(function ($e) {
                return $e;
            })
            ->right(function ($e) {
                return $e;
            })
            ->getLeftOption()
        );

        $this->assertInstanceOf(None::class, (new Right(1))
            ->left(function ($e) {
                return $e;
            })
            ->right(function ($e) {
                return $e;
            })
            ->getLeftOption()
        );
    }

    public function testRightOption()
    {
        $this->assertInstanceOf(Some::class, (new Right(1))
            ->left(function ($e) {
                return $e;
            })
            ->right(function ($e) {
                return $e;
            })
            ->getRightOption()
        );

        $this->assertInstanceOf(None::class, (new Left(1))
            ->left(function ($e) {
                return $e;
            })
            ->right(function ($e) {
                return $e;
            })
            ->getRightOption()
        );
    }
}
