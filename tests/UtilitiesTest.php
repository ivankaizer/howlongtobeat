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
}