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

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function get()
    {
        return $this->content;
    }

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
