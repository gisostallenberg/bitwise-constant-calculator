<?php

namespace GisoStallenberg\BitwiseConstantCalculator\tests;

use GisoStallenberg\BitwiseConstantCalculator\BitwiseConstantCalculator;
use PHPUnit\Framework\TestCase;

/**
 * Tests the BitwiseConstantCalculator.
 *
 * @author Giso Stallenberg
 */
class BitwiseConstantCalculatorTest extends TestCase
{
    /**
     * Test the calculation.
     *
     * @param string $string
     * @param int    $integer
     * @dataProvider parsables
     */
    public function testCalculation($string, $integer)
    {
        $result = BitwiseConstantCalculator::create()
            ->calculate($string);

        $this->assertSame($integer, $result);
    }

    /**
     * Gives parsable data.
     *
     * @return array
     */
    public function parsables()
    {
        return [
            ['E_ALL | E_STRICT', E_ALL | E_STRICT],
            ['E_ALL & ~E_NOTICE', E_ALL & ~E_NOTICE],
            ['~E_NOTICE | E_ALL', ~E_NOTICE | E_ALL],
            ['~E_NOTICE', ~E_NOTICE],
            ['~ E_NOTICE', ~E_NOTICE],
            ['~ E_NOTICE', ~E_NOTICE],
            ['E_ALL^E_STRICT', E_ALL ^ E_STRICT],
            ['E_ALL   ^   E_STRICT', E_ALL ^ E_STRICT],
        ];
    }
}
