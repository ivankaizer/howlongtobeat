<?php

use IvanKayzer\HowLongToBeat\HowLongToBeat;
use Symfony\Component\DomCrawler\Crawler;

class SearchTest extends \PHPUnit\Framework\TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    public function it_searches_for_a_game()
    {
        $hl2b = new HowLongToBeat();

        $results = $hl2b->search('The Witcher 3');

        $this->assertCount(9, $results['Results']);
    }

    /** @test */
    public function it_returns_a_game_object()
    {
        $hl2b = new HowLongToBeat();

        $results = $hl2b->search('The Witcher 3: Wild Hunt - Hearts of Stone');

        $this->assertEquals(30003, $results['Results'][0]['ID']);
        $this->assertEquals('The Witcher 3: Wild Hunt - Hearts of Stone', $results['Results'][0]['Title']);
        $this->assertEquals('https://howlongtobeat.com/games/The-Witcher-3-Wild-Hunt-Hearts-of-Stone-Expansion-Teaser.jpg', $results['Results'][0]['Image']);
        $this->assertEquals('10 Hours', $results['Results'][0]['Summary']['Main Story']);
        $this->assertEquals('14 Hours', $results['Results'][0]['Summary']['Main + Extra']);
        $this->assertEquals('18 Hours', $results['Results'][0]['Summary']['Completionist']);
        $this->assertEquals('14 Hours', $results['Results'][0]['Summary']['All Styles']);
    }

    /** @test */
    public function it_returns_null_for_empty_completion_times()
    {
        $hl2b = new HowLongToBeat();

        $results = $hl2b->search('Fable legends');

        $this->assertEquals(21275, $results['Results'][0]['ID']);
        $this->assertNull($results['Results'][0]['Summary']['Main Story']);
        $this->assertNull($results['Results'][0]['Summary']['Main + Extra']);
        $this->assertNull($results['Results'][0]['Summary']['Completionist']);
    }
}
