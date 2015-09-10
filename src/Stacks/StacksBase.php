<?php

namespace mglaman\Toolstack\Stacks;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
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
     * {@inheritdoc}
     */
    public function isType($type)
    {
        return ($type == $this->type());
    }

}
