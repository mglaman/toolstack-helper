<?php

namespace mglaman\Toolstack\Stacks;

class Drupal extends StacksBase
{
    /**
     * {@inheritdoc}
     */
    public function type()
    {
        // @todo: return if core or profile
        return 'drupal';
    }

    /**
     * {@inheritdoc}
     */
    public function inspect($dir)
    {
        // TODO: Implement inspect() method.
    }

}
