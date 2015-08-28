<?php

namespace mglaman\Toolstack\Stacks;

class Symfony extends Composer
{
    const TYPE = 'symfony';

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
        if (parent::inspect($dir)) {
            $composerData = $this->getComposerData($dir);
            return isset($composerData['require']['symfony/symfony']);
        }

        return null;
    }


}
