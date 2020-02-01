<?php

use Symfony\Component\DomCrawler\Crawler;

class GetByIdSnapshotTest extends \PHPUnit\Framework\TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    public function it_gets_game_info_from_html_snapshot_for_id_10270()
    {
        $client = Mockery::mock('Goutte\Client');
        $client->shouldReceive('request')
            ->times(1)
            ->andReturn(new Crawler(file_get_contents(__DIR__ . '/snapshots/10270.html')));

        $hl2b = new ivankayzer\HowLongToBeat\HowLongToBeat($client);

        $response = $hl2b->get(10270);

        $this->assertEquals(10270, $response['ID']);
        $this->assertEquals('The Witcher 3: Wild Hunt', $response['Title']);
        $this->assertEquals('https://howlongtobeat.com/gameimages/256px-TW3_Wild_Hunt_logo.png', $response['Image']);
        $this->assertEquals('In The Witcher 3 an ancient evil stirs, awakening. An evil that sows terror and abducts the young. An evil whose name is spoken only in whispers: the Wild Hunt. Led by four wraith commanders, this ravenous band of phantoms is the ultimate predator and has been for centuries. Its quarry: humans.', $response['Description']);
        $this->assertEquals('CD Projekt RED', $response['Developer']);
        $this->assertEquals('CD Projekt, Warner Bros. Interactive Entertainment', $response['Publisher']);
        $this->assertEquals('34 Mins Ago', $response['Last Update']);
        $this->assertEquals('Third-Person, Action, Open World, Role-Playing', $response['Genres']);
        $this->assertEquals([
            'Playing' => '3300',
            'Backlogs' => '9300',
            'Replays' => '1200',
            'Retired' => '2%',
            'Rating' => '95%',
            'Beat' => '8200',
        ], $response['Statistics']);

        $this->assertEquals([
            [
                'Main Story' => '51 Hours',
                'Main + Extras' => '103 Hours',
                'Completionist' => '173 Hours',
                'All Styles' => '101 Hours',
            ]
        ], $response['Summary']);

        $this->assertEquals([
            'Main Story' => [
                'Polled' => '1300',
                'Average' => '52h 01m',
                'Median' => '50h',
                'Rushed' => '32h 25m',
                'Leisure' => '86h 29m',
            ],
            'Main + Extras' => [
                'Polled' => '3200',
                'Average' => '105h 41m',
                'Median' => '100h',
                'Rushed' => '61h 25m',
                'Leisure' => '291h 25m',
            ],
            'Completionists' => [
                'Polled' => '1100',
                'Average' => '181h 25m',
                'Median' => '166h',
                'Rushed' => '116h 51m',
                'Leisure' => '469h 29m',
            ],
            'All PlayStyles' => [
                'Polled' => '5500',
                'Average' => '107h 32m',
                'Median' => '95h',
                'Rushed' => '57h 33m',
                'Leisure' => '433h 16m',
            ]
        ], $response['Single-Player']);

        $this->assertEquals([
            'Any%' => [
                'Polled' => '8',
                'Average' => '20h 50m 03s',
                'Median' => '21h 15m 41s',
                'Fastest' => '10h 14m',
                'Slowest' => '30h',
            ],
            '100%' => [
                'Polled' => '3',
                'Average' => '63h 20m',
                'Median' => '60h',
                'Fastest' => '50h',
                'Slowest' => '80h',
            ],
        ], $response['Speedrun']);

        $this->assertEquals([
            'Nintendo Switch' => [
                'Polled' => '20',
                'Main' => '53h 48m',
                'Main +' => '82h 50m',
                '100%' => '150h',
                'Fastest' => '31h 55m',
                'Longest' => '150h',
            ],
            'PC' => [
                'Polled' => '3600',
                'Main' => '52h 08m',
                'Main +' => '103h 28m',
                '100%' => '179h 20m',
                'Fastest' => '13h 51m',
                'Longest' => '752h',
            ],
            'PlayStation 4' => [
                'Polled' => '1400',
                'Main' => '51h 36m',
                'Main +' => '108h 01m',
                '100%' => '189h 51m',
                'Fastest' => '15h',
                'Longest' => '765h 17m',
            ],
            'Xbox One' => [
                'Polled' => '488',
                'Main' => '52h 27m',
                'Main +' => '116h 20m',
                '100%' => '173h 11m',
                'Fastest' => '15h 14m',
                'Longest' => '475h 52m',
            ],
        ], $response['Platform']);
    }


    /** @test */
    public function it_gets_game_info_from_html_snapshot_for_id_21275()
    {
        $client = Mockery::mock('Goutte\Client');
        $client->shouldReceive('request')
            ->times(1)
            ->andReturn(new Crawler(file_get_contents(__DIR__ . '/snapshots/21275.html')));

        $hl2b = new ivankayzer\HowLongToBeat\HowLongToBeat($client);

        $response = $hl2b->get(21275);

        $this->assertEquals(21275, $response['ID']);
        $this->assertEquals('Fable Legends', $response['Title']);
        $this->assertEquals('https://howlongtobeat.com/gameimages/Fable_Legends.jpg', $response['Image']);
        $this->assertEquals('Magic is rife and all manner of creatures and miscreants inhabit the world off the beaten track. Eyes watch the unwary from the shadowy canopy of the forest. Are you brave enough to venture outside the walls of Brightlodge? Will you leave the welcoming taverns and the even more welcoming arms of Betsy (or Brian) the barkeep and strike a new path into the unknown? There are quests and treasure aplenty awaiting you if you do.', $response['Description']);
        $this->assertEquals('Lionhead Studios', $response['Developer']);
        $this->assertEquals('Microsoft Studios', $response['Publisher']);
        $this->assertEquals('1.5 Weeks Ago', $response['Last Update']);
        $this->assertEquals('Third-Person, Role-Playing', $response['Genres']);
        $this->assertEquals([
            'Playing' => '1',
            'Backlogs' => '6',
            'Replays' => '0',
            'Retired' => '14%',
            'Rating' => 'NR',
            'Beat' => '0',
        ], $response['Statistics']);

        $this->assertEquals([
            [
                'Main Story' => null,
                'Main + Extras' => null,
                'Completionist' => null,
                'All Styles' => null,
            ]
        ], $response['Summary']);

        $this->assertArrayNotHasKey('Single-Player', $response);
        $this->assertArrayNotHasKey('Speedrun', $response);
        $this->assertArrayNotHasKey('Platform', $response);
    }

    /** @test */
    public function it_gets_game_info_from_html_snapshot_for_id_41753()
    {
        $client = Mockery::mock('Goutte\Client');
        $client->shouldReceive('request')
            ->times(1)
            ->andReturn(new Crawler(file_get_contents(__DIR__ . '/snapshots/41753.html')));

        $hl2b = new ivankayzer\HowLongToBeat\HowLongToBeat($client);

        $response = $hl2b->get(41753);

        $this->assertEquals(41753, $response['ID']);
        $this->assertEquals('The Last of Us: Part II', $response['Title']);
        $this->assertEquals('https://howlongtobeat.com/gameimages/41753_The_Last_of_Us_Part_II.jpg', $response['Image']);
        $this->assertEquals('Five years after their dangerous journey across the post-pandemic United States, Ellie and Joel have settled down in Jackson, Wyoming. Living amongst a thriving community of survivors has allowed them peace and stability, despite the constant threat of the infected and other, more desperate survivors. When a violent event disrupts that peace, Ellie embarks on a relentless journey to carry out justice and find closure. As she hunts those responsible one by one, she is confronted with the devastating physical and emotional repercussions of her actions.', $response['Description']);
        $this->assertEquals('Naughty Dog', $response['Developer']);
        $this->assertEquals('Sony Interactive Entertainment', $response['Publisher']);
        $this->assertEquals('1 Day Ago', $response['Last Update']);
        $this->assertEquals('Third-Person, Action, Adventure, Horror, Shooter, Survival', $response['Genres']);
        $this->assertEquals([
            'Playing' => '2',
            'Backlogs' => '218',
            'Replays' => '2',
            'Retired' => '0%',
            'Rating' => 'NR',
            'Beat' => '0',
        ], $response['Statistics']);

        $this->assertEquals([
            [
                'Main Story' => null,
                'Main + Extras' => null,
                'Completionist' => null,
                'All Styles' => null,
            ]
        ], $response['Summary']);

        $this->assertArrayNotHasKey('Single-Player', $response);
        $this->assertArrayNotHasKey('Speedrun', $response);
        $this->assertArrayNotHasKey('Platform', $response);
    }
}