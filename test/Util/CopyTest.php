<?php

namespace PhpSlang\Util;

use PHPUnit_Framework_TestCase;

class CloneableClassExample
{
    use Copy;

    /**
     * @var string
     */
    private $someValue;

    /**
     * TestImmutableClass constructor.
     *
     * @param string $someValue
     */
    public function __construct(string $someValue)
    {
        $this->someValue = $someValue;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->someValue;
    }

    /**
     * @param string $someValue
     *
     * @return CloneableClassExample
     */
    public function withValue(string $someValue): CloneableClassExample
    {
        return $this->copy('someValue', $someValue);
    }
}

class CopyTest extends PHPUnit_Framework_TestCase
{
    public function testImmutableConstructor()
    {
        $this->assertInstanceOf(CloneableClassExample::class, new CloneableClassExample('example'));
    }

    public function testImmutableClone()
    {
        $immutableWith = (new CloneableClassExample('example'))->withValue('example2');
        $this->assertInstanceOf(CloneableClassExample::class, $immutableWith);
        $this->assertEquals('example2', $immutableWith->getValue());
    }

}
