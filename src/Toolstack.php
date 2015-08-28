<?php

namespace mglaman\Toolstack;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;
use mglaman\Toolstack\Stacks;
use mglaman\Toolstack\Stacks\StacksInterface;

class Toolstack
{
    protected static $instance;

    /**
     * @var StacksInterface[]
     */
    protected $stacks = [];

    /**
     * @var Filesystem;
     */
    protected $fs;


    /**
     * Singleton constructor for Zuora API.
     *
     * @return Toolstack
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Sets up toolstack helper.
     */
    public function __construct()
    {
        $this->fs     = new Filesystem();
        $this->stacks = $this->loadStacks();
    }

    /**
     * Loads available stacks.
     *
     * @return StacksInterface[]
     */
    protected function loadStacks()
    {
        // Add composer last, in case it catches any other projects on accident.
        return [
          new Stacks\Drupal(),
          new Stacks\Symfony(),
          new Stacks\WordPress(),
          new Stacks\Composer(),
        ];
    }

    /**
     * Returns available stacks.
     *
     * @return StacksInterface[]
     */
    public function getStacks()
    {
        return $this->stacks;
    }

    /**
     * Returns a stack based on type.
     *
     * @param $type
     *
     * @return \mglaman\Toolstack\Stacks\StacksInterface|null
     */
    public function getStackByType($type)
    {
        foreach ($this->getStacks() as $stack) {
            if ($stack->isType($type)) {
                return $stack;
            }
        }
        return null;
    }

    /**
     * Returns a stack by directory.
     * @param $dir
     *
     * @return \mglaman\Toolstack\Stacks\StacksInterface|null
     */
    public function getStackByDir($dir)
    {
        return $this->getStackByType($this->inspect($dir));
    }

    /**
     * Inspects directory with stacks.
     *
     * @param $dir
     *
     * @return null|string
     */
    public function inspect($dir)
    {
        if (!$this->fs->exists($dir)) {
            throw new FileNotFoundException('Directory does not exist');
        }

        foreach ($this->getStacks() as $stack) {
            if ($stack->inspect($dir) === true) {
                return $stack->type();
            }
        }

        // Stacks were not able to identify the structure.
        return null;
    }
}
