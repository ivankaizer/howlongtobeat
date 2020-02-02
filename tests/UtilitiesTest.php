<?php

use IvanKayzer\HowLongToBeat\Utilities;

class UtilitiesTest extends \PHPUnit\Framework\TestCase
{
    public $utilities;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->utilities = new Utilities();
    }

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

        $this->assertEquals($expected, $this->utilities->flattenArray($array));
    }

    /** @test */
    public function convertAbbreviationsToNumber_converts_polled_numbers()
    {
        $this->assertEquals('1300', $this->utilities->convertAbbreviationsToNumber('1.3K'));
        $this->assertEquals('5000', $this->utilities->convertAbbreviationsToNumber('5K'));
        $this->assertEquals('1000', $this->utilities->convertAbbreviationsToNumber('1.0K'));
        $this->assertEquals('8', $this->utilities->convertAbbreviationsToNumber('8'));
        $this->assertEquals('2%', $this->utilities->convertAbbreviationsToNumber('2%'));
        $this->assertEquals('55h 25m', $this->utilities->convertAbbreviationsToNumber('55h 25m'));
    }

    /** @test */
    public function formatTime_converts_dashes_to_null()
    {
        $this->assertNull($this->utilities->formatTime('--'));
        $this->assertEquals('10h', $this->utilities->formatTime('10h'));
        $this->assertEquals('10h 5m', $this->utilities->formatTime('10h 5m'));
        $this->assertEquals('5m', $this->utilities->formatTime('5m'));
    }

    /** @test */
    public function formatTime_converts_special_symbols()
    {
        $this->assertEquals('10.5 Hours', $this->utilities->formatTime('10½ Hours'));
    }
}
