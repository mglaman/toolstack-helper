<?php

namespace mglaman\Toolstack\Stacks;

interface StacksInterface
{

    /**
     * Returns the stack type, or null if none.
     *
     * @return string|null
     */
    public function type();

    /**
     * Checks if a given type matches this stack.
     *
     * @param $type
     *
     * @return bool
     */
    public function isType($type);

    /**
     * Inspects a directory.
     *
     * @param $dir
     *
     * @return bool
     */
    public function inspect($dir);

}
