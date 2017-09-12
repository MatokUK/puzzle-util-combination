<?php

namespace Matok\Util\Tests;

use Matok\Util\Combination;
use PHPUnit\Framework\TestCase;

class CombinationTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmptyArgumentThrowsException()
    {
        $combination = new Combination([]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmptyFragmentThrowsException()
    {
        $combination = new Combination(['abc', null]);
    }

}