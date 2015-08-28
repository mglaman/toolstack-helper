<?php

namespace mglaman\Toolstack\Stacks;

use Symfony\Component\Finder\Finder;

class Drupal extends StacksBase
{
    const TYPE = 'drupal';

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
        if ($this->source($dir)) {
            return true;
        } elseif ($this->built($dir)) {
            return true;
        }
        return false;
    }

    /**
     * Return Finder with all makesfiles in directory.
     *
     * @param $dir
     *
     * @return \Symfony\Component\Finder\Finder
     */
    public function getMakefiles($dir)
    {
        $finder = new Finder();
        $finder->in($dir)
               ->files()
               ->depth('< 1')
               ->name('*.make*');
        return $finder;
    }

    /**
     * Checks if Drupal project, but source.
     *
     * @param $dir
     *
     * @return bool
     */
    public function source($dir)
    {
        // Check if unbuilt Drupal
        foreach ($this->getMakefiles($dir) as $file) {
            $f = fopen($file, 'r');
            $peek = fread($f, 1000);
            fclose($f);
            if (strpos($peek, 'api') !== FALSE && strpos($peek, 'core') !== FALSE) {
                return true;
            }
        }

        return false;
    }

    /**
     * Checks if there is a built Drupal project.
     * @param $dir
     *
     * @return bool
     */
    public function built($dir)
    {
        $file = $dir . '/index.php';
        if ($this->fs->exists($file)) {
            $f = fopen($file, 'r');
            $beginning = fread($f, 3178);
            fclose($f);
            if (strpos($beginning, 'Drupal') !== false) {
                return true;
            }
        }
        return false;
    }
}
