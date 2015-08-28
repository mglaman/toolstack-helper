<?php

namespace mglaman\Toolstack\Stacks;

class Symfony extends Composer
{
    /**
     * {@inheritdoc}
     */
    public function type()
    {
        return 'symfony';
    }

    /**
     * {@inheritdoc}
     */
    public function inspect($dir)
    {
        if (parent::inspect($dir)) {
            $composerData = $this->getComposerData($dir);
            return isset($composerData['require']['symfony/symfony']);
        }

        return null;
    }


}
