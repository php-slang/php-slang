<?php

namespace PhpSlang\Util\Trampoline;

use PhpSlang\Util\Copy;

class Trampoline
{
    use Copy;

    /**
     * @var Trampoline
     */
    protected $content;

    /**
     * Trampoline constructor.
     *
     * @param $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return Trampoline
     */
    public function get()
    {
        return $this->content;
    }

    /**
     * @return Trampoline
     */
    public function run()
    {
        $result = new Bounce(function () {
            return ($this->content)();
        });
        while ($result instanceof Bounce) {
            $result = $result->run();
        }
        return $result->run()->get();
    }
}
