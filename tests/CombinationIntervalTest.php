<?php

namespace Matok\Util\Tests;

use Matok\Util\CombinationInterval;
use PHPUnit\Framework\TestCase;

class CombinationIntervalTest extends TestCase
{
    public function testCurrentValue()
    {
        $combination = new CombinationInterval('ab', 2, 3);

        $firstValue = $combination->current();
        $combination->next(); // ba
        $combination->next(); // ab
        $combination->next(); // bb
        $combination->next(); // aaa
        $combination->next(); // baa
        $otherValue = $combination->current();

        $this->assertEquals('aa', $firstValue);
        $this->assertEquals('baa', $otherValue);
    }

    public function testCount()
    {
        $combination = new CombinationInterval('ab', 2, 5);

        $this->assertEquals(60, $combination->count());
    }
}