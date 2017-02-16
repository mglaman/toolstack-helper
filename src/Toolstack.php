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
     * @return \mglaman\Toolstack\Stacks\StacksInterface
     */
    public static function getStackByType($type)
    {
        foreach (self::getStacks() as $stack) {
            if ($stack->isType($type)) {
                return $stack;
            }
        }
        return new Stacks\NullStack();
    }

    /**
     * Inspects directory with stacks.
     *
     * @param $dir
     *
     * @return \mglaman\Toolstack\Stacks\StacksInterface
     */
    public static function inspect($dir)
    {
        if (!is_dir($dir)) {
            throw new FileNotFoundException(sprintf('Directory "%s" does not exist.', $dir));
        }

        foreach (self::getStacks() as $stack) {
            if ($stack->inspect($dir) === true) {
                return $stack;
            }
        }

        // Stacks were not able to identify the structure.
        return new Stacks\NullStack();
    }
}
