<?php

use ivankayzer\HowLongToBeat\Utilities;

class UtilitiesTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function flattenArray_flattens_an_array()
    {
        $array = [
            ['x' => 1, 'z' => 3],
            ['y' => 2]
        ];

        $expected = [
            'x' => 1,
            'y' => 2,
            'z' => 3
        ];

        $this->assertEquals($expected, Utilities::flattenArray($array));
    }

    /** @test */
    public function convertAbbreviationsToNumber_converts_polled_numbers()
    {
        $this->assertEquals('1300', Utilities::convertAbbreviationsToNumber('1.3K'));
        $this->assertEquals('5000', Utilities::convertAbbreviationsToNumber('5K'));
        $this->assertEquals('1000', Utilities::convertAbbreviationsToNumber('1.0K'));
        $this->assertEquals('8', Utilities::convertAbbreviationsToNumber('8'));
        $this->assertEquals('2%', Utilities::convertAbbreviationsToNumber('2%'));
        $this->assertEquals('55h 25m', Utilities::convertAbbreviationsToNumber('55h 25m'));
    }
}