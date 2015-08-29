<?php

namespace mglaman\Toolstack\Stacks;

class WordPress extends StacksBase
{
    const TYPE = 'wordress';

    /**
     * {@inheritdoc}
     */
    public function type()
    {
        return self::TYPE;
    }

    /**
     * {@inheritdoc}
     */
    public function inspect($dir)
    {
        return $this->fs->exists([
            $dir . '/wp-load.php',
        ]);
    }

}
