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

        $hl2b = new IvanKayzer\HowLongToBeat\HowLongToBeat($client);

        $response = $hl2b->get(10270);

        $this->assertEquals(10270, $response['ID']);
        $this->assertEquals('The Witcher 3: Wild Hunt', $response['Title']);
        $this->assertEquals('https://howlongtobeat.com/games/10270_The_Witcher_3_Wild_Hunt.jpg', $response['Image']);
        $this->assertEquals('In The Witcher 3 an ancient evil stirs, awakening. An evil that sows terror and abducts the young. An evil whose name is spoken only in whispers: the Wild Hunt. Led by four wraith commanders, this ravenous band of phantoms is the ultimate predator and has been for centuries. Its quarry: humans.', $response['Description']);
        $this->assertEquals('CD Projekt RED', $response['Developer']);
        $this->assertEquals('CD Projekt, Warner Bros. Interactive Entertainment', $response['Publisher']);
        $this->assertEquals('1 Hour Ago', $response['Last Update']);
        $this->assertEquals('Third-Person, Action, Open World, Role-Playing', $response['Genres']);
        $this->assertEquals([
            'Playing' => '260',
            'Backlogs' => '14500',
            'Replays' => '1500',
            'Retired' => '2%',
            'Rating' => '94%',
            'Beat' => '14800',
        ], $response['Statistics']);

        $this->assertEquals([
            'Main Story' => '51 Hours',
            'Main + Extras' => '103 Hours',
            'Completionist' => '172 Hours',
            'All Styles' => '102 Hours',
        ], $response['Summary'][0]['Time']);

        $this->assertNull($response['Summary'][0]['Title']);

        $this->assertEquals([
            'Main Story' => [
                'Polled' => '2100',
                'Average' => '52h 18m',
                'Median' => '50h',
                'Rushed' => '32h 27m',
                'Leisure' => '85h 34m',
            ],
            'Main + Extras' => [
                'Polled' => '5000',
                'Average' => '105h 59m',
                'Median' => '100h',
                'Rushed' => '61h 29m',
                'Leisure' => '292h 59m',
            ],
            'Completionists' => [
                'Polled' => '1700',
                'Average' => '179h 05m',
                'Median' => '166h',
                'Rushed' => '116h 16m',
                'Leisure' => '468h 54m',
            ],
            'All PlayStyles' => [
                'Polled' => '8900',
                'Average' => '107h 34m',
                'Median' => '95h 56m',
                'Rushed' => '57h 45m',
                'Leisure' => '433h 31m',
            ]
        ], $response['Single-Player']);

        $this->assertEquals([
            'Any%' => [
                'Polled' => '14',
                'Average' => '16h 15m 19s',
                'Median' => '13h 15m 57s',
                'Fastest' => '3h 09m 01s',
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
                'Polled' => '184',
                'Main' => '56h 27m',
                'Main +' => '111h 33m',
                '100%' => '176h 48m',
                'Fastest' => '18h 16m',
                'Longest' => '300h',
            ],
            'PC' => [
                'Polled' => '5900',
                'Main' => '52h 26m',
                'Main +' => '104h 32m',
                '100%' => '177h 26m',
                'Fastest' => '13h 45m',
                'Longest' => '750h',
            ],
            'PlayStation 4' => [
                'Polled' => '2100',
                'Main' => '51h 34m',
                'Main +' => '107h 32m',
                '100%' => '185h 32m',
                'Fastest' => '15h',
                'Longest' => '765h 17m',
            ],
            'Xbox One' => [
                'Polled' => '670',
                'Main' => '52h 20m',
                'Main +' => '113h 50m',
                '100%' => '175h',
                'Fastest' => '15h 14m',
                'Longest' => '475h 52m',
            ],
            'Xbox Series X/S' => [
                'Polled' => '16',
                'Main' => '47h 55m',
                'Main +' => '86h 43m',
                '100%' => '226h',
                'Fastest' => '24h',
                'Longest' => '226h',
            ],
            'PlayStation 5' => [
                'Polled' => '11',
                'Main' => '48h 30m',
                'Main +' => '76h 56m',
                '100%' => '--',
                'Fastest' => '40h',
                'Longest' => '105h 55m',
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

        $hl2b = new IvanKayzer\HowLongToBeat\HowLongToBeat($client);

        $response = $hl2b->get(21275);

        $this->assertEquals(21275, $response['ID']);
        $this->assertEquals('Fable Legends', $response['Title']);
        $this->assertEquals('https://howlongtobeat.com/games/Fable_Legends.jpg', $response['Image']);
        $this->assertEquals('Magic is rife and all manner of creatures and miscreants inhabit the world off the beaten track. Eyes watch the unwary from the shadowy canopy of the forest. Are you brave enough to venture outside the walls of Brightlodge? Will you leave the welcoming taverns and the even more welcoming arms of Betsy (or Brian) the barkeep and strike a new path into the unknown? There are quests and treasure aplenty awaiting you if you do.', $response['Description']);
        $this->assertEquals('Lionhead Studios', $response['Developer']);
        $this->assertEquals('Microsoft Studios', $response['Publisher']);
        $this->assertEquals('1.5 Months Ago', $response['Last Update']);
        $this->assertEquals('Third-Person, Role-Playing', $response['Genres']);
        $this->assertEquals([
            'Playing' => '0',
            'Backlogs' => '6',
            'Replays' => '0',
            'Retired' => '14%',
            'Rating' => 'NR',
            'Beat' => '0',
        ], $response['Statistics']);

        $this->assertEquals([
            'Main Story' => null,
            'Main + Extras' => null,
            'Completionist' => null,
            'All Styles' => null,
        ], $response['Summary'][0]['Time']);

        $this->assertNull($response['Summary'][0]['Title']);

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

        $hl2b = new IvanKayzer\HowLongToBeat\HowLongToBeat($client);

        $response = $hl2b->get(41753);

        $this->assertEquals(41753, $response['ID']);
        $this->assertEquals('The Last of Us Part II', $response['Title']);
        $this->assertEquals('https://howlongtobeat.com/games/41753_The_Last_of_Us_Part_II.jpg', $response['Image']);
        $this->assertEquals('Five years after their dangerous journey across the post-pandemic United States, Ellie and Joel have settled down in Jackson, Wyoming. Living amongst a thriving community of survivors has allowed them peace and stability, despite the constant threat of the infected and other, more desperate survivors. When a violent event disrupts that peace, Ellie embarks on a relentless journey to carry out justice and find closure. As she hunts those responsible one by one, she is confronted with the devastating physical and emotional repercussions of her actions.', $response['Description']);
        $this->assertEquals('Naughty Dog', $response['Developer']);
        $this->assertEquals('Sony Interactive Entertainment', $response['Publisher']);
        $this->assertEquals('5 Mins Ago', $response['Last Update']);
        $this->assertEquals('Third-Person, Action, Adventure, Horror, Shooter, Survival', $response['Genres']);
        $this->assertEquals([
            'Playing' => '51',
            'Backlogs' => '1900',
            'Replays' => '159',
            'Retired' => '1%',
            'Rating' => '89%',
            'Beat' => '6300',
        ], $response['Statistics']);

        $this->assertEquals([
            'Main Story' => '24 Hours',
            'Main + Extras' => '29.5 Hours',
            'Completionist' => '42 Hours',
            'All Styles' => '28 Hours',
        ], $response['Summary'][0]['Time']);
    }

    /** @test */
    public function it_gets_game_info_from_html_snapshot_for_id_1468()
    {
        $client = Mockery::mock('Goutte\Client');
        $client->shouldReceive('request')
            ->times(1)
            ->andReturn(new Crawler(file_get_contents(__DIR__ . '/snapshots/1468.html')));

        $hl2b = new IvanKayzer\HowLongToBeat\HowLongToBeat($client);

        $response = $hl2b->get(1468);

        $this->assertEquals(1468, $response['ID']);
        $this->assertEquals('Call of Duty 4: Modern Warfare', $response['Title']);
        $this->assertEquals('https://howlongtobeat.com/games/Call_of_Duty_4_Modern_Warfare.jpg', $response['Image']);
        $this->assertEquals('Call of Duty 4: Modern Warfare, the new action thriller from the award-winning team at Infinity Ward, the creators of the Call of Duty series, delivers the most intense and cinematic action experience ever. Armed with an arsenal of advanced and powerful modern-day firepower, players are transported to treacherous hotspots around the globe to take on a rogue enemy group threatening the world. As both a U.S. Marine and British S.A.S. soldier fighting through an unfolding story full of twists and turns, players use sophisticated technology, superior firepower, and coordinated land and air strikes on a battlefield where speed, accuracy, and communication are essential to victory. The epic title also delivers an added depth of multiplayer action providing online fans an all-new community of persistence, addictive, and customizable gameplay.', $response['Description']);
        $this->assertEquals('Infinity Ward', $response['Developer']);
        $this->assertEquals('Activision', $response['Publisher']);
        $this->assertEquals('Nintendo DS, PC, PlayStation 3, Xbox 360', $response['Playable On']);
        $this->assertEquals('53 Mins Ago', $response['Last Update']);
        $this->assertEquals('First-Person, Shooter', $response['Genres']);
        $this->assertEquals([
            'Playing' => '20',
            'Backlogs' => '1300',
            'Replays' => '176',
            'Retired' => '4%',
            'Rating' => '81%',
            'Beat' => '5200',
        ], $response['Statistics']);

        $this->assertEquals([
            'Main Story' => '5h',
            'Main + Extras' => '5h',
            'Completionist' => '13h',
            'All Styles' => '5h',
        ], $response['Summary'][0]['Time']);

        $this->assertEquals([
            'Main Story' => '7h',
            'Main + Extras' => '10h',
            'Completionist' => '15h',
            'All Styles' => '8h',
        ], $response['Summary'][1]['Time']);

        $this->assertEquals('Nintendo DS, Xbox One', $response['Summary'][0]['Title']);
        $this->assertEquals('PC, PlayStation 3, Xbox 360', $response['Summary'][1]['Title']);
    }
}
