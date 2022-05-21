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
        $this->assertEquals('10 Hours', $results['Results'][0]['Time']['Main Story']);
        $this->assertEquals('14 Hours', $results['Results'][0]['Time']['Main + Extra']);
        $this->assertEquals('18.5 Hours', $results['Results'][0]['Time']['Completionist']);
    }

    /** @test */
    public function it_returns_null_for_empty_completion_times()
    {
        $hl2b = new HowLongToBeat();

        $results = $hl2b->search('Fable legends');

        $this->assertEquals(21275, $results['Results'][0]['ID']);
        $this->assertNull($results['Results'][0]['Time']['Main Story']);
        $this->assertNull($results['Results'][0]['Time']['Main + Extra']);
        $this->assertNull($results['Results'][0]['Time']['Completionist']);
    }

    /** @test */
    public function card_can_have_main_story_main_and_completionist_fields()
    {
        $client = Mockery::mock('Goutte\Client');
        $client->shouldReceive('request')
            ->times(1)
            ->andReturn(new Crawler(file_get_contents(__DIR__ . '/templates/default_card.html')));

        $hl2b = new HowLongToBeat($client);

        $result = $hl2b->search('Lego');

        $this->assertEquals([
            'ID' => '5256',
            'Image' => 'https://howlongtobeat.com/games/Lego_Pirates_of_the_Caribbean.jpg',
            'Title' => 'LEGO Pirates of the Caribbean: The Video Game',
            'Time' => [
                'Main Story' => '8.5 Hours',
                'Main + Extra' => '15 Hours',
                'Completionist' => '24.5 Hours',
            ]
        ], $result['Results'][0]);
    }

    /** @test */
    public function card_can_have_solo_co_op_and_vs_fields()
    {
        $client = Mockery::mock('Goutte\Client');
        $client->shouldReceive('request')
            ->times(1)
            ->andReturn(new Crawler(file_get_contents(__DIR__ . '/templates/solo_co-op_card.html')));

        $hl2b = new HowLongToBeat($client);

        $result = $hl2b->search('Lego');

        $this->assertEquals([
            'ID' => '47803',
            'Image' => 'https://howlongtobeat.com/games/47803_Lego_Harry_Potter_Collection.jpg',
            'Title' => 'LEGO Harry Potter Collection',
            'Time' => [
                'Solo' => '41 Hours',
                'Co-Op' => '55 Hours',
                'Vs.' => null,
            ]
        ], $result['Results'][0]);
    }
}
