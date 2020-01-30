<?php

use ivankayzer\HowLongToBeat\HowLongToBeat;

class SearchTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_searches_for_a_game()
    {
        $hl2b = new HowLongToBeat();

        $results = $hl2b->search('The Witcher 3');

        $this->assertCount(4, $results);
    }

    /** @test */
    public function it_returns_a_game_object()
    {
        $hl2b = new HowLongToBeat();

        $results = $hl2b->search('The Witcher 3: Wild Hunt - Hearts of Stone');

        $this->assertEquals(30003, $results[0]['id']);
        $this->assertEquals('The Witcher 3: Wild Hunt - Hearts of Stone', $results[0]['name']);
        $this->assertEquals('https://howlongtobeat.com/gameimages/The-Witcher-3-Wild-Hunt-Hearts-of-Stone-Expansion-Teaser.jpg', $results[0]['image']);
        $this->assertEquals('10 Hours', $results[0]['main_story']);
        $this->assertEquals('14 Hours', $results[0]['main_and_extra']);
        $this->assertEquals('19 Hours', $results[0]['completionist']);
    }

    /** @test */
    public function it_returns_null_for_empty_completion_times()
    {
        $hl2b = new HowLongToBeat();

        $results = $hl2b->search('Fable legends');

        $this->assertEquals(21275, $results[0]['id']);
        $this->assertNull($results[0]['main_story']);
        $this->assertNull($results[0]['main_and_extra']);
        $this->assertNull($results[0]['completionist']);
    }
}