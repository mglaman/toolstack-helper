<?php

namespace mglaman\Toolstack\Stacks;

use Symfony\Component\Finder\Finder;

class Drupal extends StacksBase
{
    const TYPE = 'drupal';
    const DRUPAL7 = '7.x';
    const DRUPAL8 = '8.x';

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
     * Return Finder with all makefiles in directory.
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

    /**
     * Determine the Drupal version (make sources or built.)
     *
     * @param $dir
     * @return null|string
     */
    public function version($dir) {
        if ($this->source($dir)) {
            // Check if unbuilt Drupal
            foreach ($this->getMakefiles($dir) as $file) {
                $f = fopen($file, 'r');
                $peek = fread($f, 1000);
                fclose($f);
                foreach (explode(PHP_EOL, $peek) as $line) {
                    preg_match("/core\s*(:|=)\s*\"?(\d.\w?)\"?$/", $line, $output_array);
                    if (!empty($output_array)) {
                        return ($output_array[2] == self::DRUPAL7) ? self::DRUPAL7 : self::DRUPAL8;
                    }
                }
            }
        } elseif ($this->built($dir)) {
            return (file_exists($dir . '/composer.json')) ? self::DRUPAL8 : self::DRUPAL7;
        }
        return null;
    }
}
