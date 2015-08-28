<?php

namespace mglaman\Toolstack\Stacks;

use Symfony\Component\Filesystem\Filesystem;

abstract class StacksBase implements StacksInterface
{
    protected $dir;

    /**
     * @var Filesystem;
     */
    protected $fs;

    public function __construct()
    {
        $this->fs = new Filesystem();
    }

    /**
     * Checks if a given type matches this stack.
     *
     * @param $type
     *
     * @return bool
     */
    public function isType($type)
    {
        return ($type == $this->type());
    }

}
