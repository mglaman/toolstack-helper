<?php
/**
 * Created by PhpStorm.
 * User: mglaman
 * Date: 8/28/15
 * Time: 2:20 AM
 */

namespace mglaman\Toolstack\Tests\Stacks;

use mglaman\Toolstack\Toolstack;

abstract class StackBaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Toolstack
     */
    protected $toolsstack;

    protected function setUp()
    {
        parent::setUp();
        $this->toolsstack = Toolstack::instance();
    }

}
