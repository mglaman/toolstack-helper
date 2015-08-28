<?php

namespace mglaman\Toolstack;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;
use mglaman\Toolstack\Stacks;
use mglaman\Toolstack\Stacks\StacksInterface;

class Toolstack
{
    /**
     * Returns available stacks.
     *
     * @return StacksInterface[]
     */
    public static function getStacks()
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
     * Returns a stack based on type.
     *
     * @param $type
     *
     * @return \mglaman\Toolstack\Stacks\StacksInterface|null
     */
    public static function getStackByType($type)
    {
        foreach (self::getStacks() as $stack) {
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
    public static function getStackByDir($dir)
    {
        return self::getStackByType(self::inspect($dir));
    }

    /**
     * Inspects directory with stacks.
     *
     * @param $dir
     *
     * @return null|string
     */
    public static function inspect($dir)
    {
        $fs = new Filesystem();
        if (!$fs->exists($dir)) {
            throw new FileNotFoundException('Directory does not exist');
        }

        foreach (self::getStacks() as $stack) {
            if ($stack->inspect($dir) === true) {
                return $stack->type();
            }
        }

        // Stacks were not able to identify the structure.
        return null;
    }
}
