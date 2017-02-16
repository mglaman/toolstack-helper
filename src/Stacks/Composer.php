<?php

namespace mglaman\Toolstack\Stacks;

class Composer extends StacksBase
{

    const TYPE = 'composer';

    /**
     * {@inheritdoc}
     */
    public function type()
    {
        return static::TYPE;
    }

    /**
     * {@inheritdoc}
     */
    public function inspect($dir)
    {
        return $this->fs->exists($this->composerFilePath($dir));
    }

    public function installed($dir)
    {
        return $this->fs->exists($this->composerLockPath($dir));
    }

    /**
     * Returns file path for composer.json
     * @param $dir
     *
     * @return string
     */
    public function composerFilePath($dir) {
        return "$dir/composer.json";
    }

    /**
     * Returns file path for composer.lock
     * @param $dir
     *
     * @return string
     */
    public function composerLockPath($dir) {
        return "$dir/composer.lock";
    }

    /**
     * Returns data from composer.json
     *
     * @param $dir
     *
     * @return mixed
     */
    public function getComposerData($dir) {
        return json_decode(file_get_contents($this->composerFilePath($dir)), true);
    }

}
