<?php

namespace Matok\Util\Tests;

use Matok\Util\Combination;
use PHPUnit\Framework\TestCase;

class CountableTest extends TestCase
{
    /**
     * @dataProvider getCountTests
     */
    public function testCount($vector, $expectedCount)
    {
        $combination = new Combination($vector);

        $this->assertEquals($expectedCount, count($combination));
    }

    public function getCountTests()
    {
        return [
            [[[9]], 1],
            [['ABC'], 3],
            [[['A', 'B', 'C']], 3],
            [[['A', 'B', 'C'], [1, 2], 'XYZ'], 18],
        ];
    }
}