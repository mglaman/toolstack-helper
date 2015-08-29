<?php
/**
 * Created by PhpStorm.
 * User: mglaman
 * Date: 8/28/15
 * Time: 8:54 PM
 */

namespace mglaman\Toolstack\Stacks;


class NullStack extends StacksBase
{

    /**
     * {@inheritdoc}
     */
    public function type()
    {
        return null;
    }

    /**
     * Inspects a directory.
     *
     * @param $dir
     *
     * @return bool
     */
    public function inspect($dir)
    {
        // TODO: Implement inspect() method.
    }

}
