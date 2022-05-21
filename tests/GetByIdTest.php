<?php

use IvanKayzer\HowLongToBeat\HowLongToBeat;

class GetByIdTest extends \PHPUnit\Framework\TestCase
{
    protected $hl2b;

    protected function setUp()
    {
        parent::setUp();

        $this->hl2b = new HowLongToBeat();
    }

    /** @test */
    public function it_returns_basic_info()
    {
        $game = $this->hl2b->get(10270);

        $this->assertEquals(10270, $game['ID']);
        $this->assertEquals('The Witcher 3: Wild Hunt', $game['Title']);
        $this->assertEquals('https://howlongtobeat.com/games/10270_The_Witcher_3_Wild_Hunt.jpg', $game['Image']);
        $this->assertEquals('In The Witcher 3 an ancient evil stirs, awakening. An evil that sows terror and abducts the young. An evil whose name is spoken only in whispers: the Wild Hunt. Led by four wraith commanders, this ravenous band of phantoms is the ultimate predator and has been for centuries. Its quarry: humans.', $game['Description']);
        $this->assertEquals('CD Projekt RED', $game['Developer']);
        $this->assertEquals('CD Projekt, Warner Bros. Interactive Entertainment', $game['Publisher']);
        $this->assertEquals('Nintendo Switch, PC, PlayStation 4, Xbox One', $game['Playable On']);
        $this->assertEquals('Third-Person, Action, Open World, Role-Playing', $game['Genres']);
    }


    /** @test */
    public function it_returns_game_stats()
    {
        $game = $this->hl2b->get(10270);

        $this->assertGreaterThan(1, strlen($game['Statistics']['Playing']));
        $this->assertGreaterThan(1, strlen($game['Statistics']['Backlogs']));
        $this->assertGreaterThan(1, strlen($game['Statistics']['Replays']));
        $this->assertGreaterThan(1, strlen($game['Statistics']['Retired']));
        $this->assertGreaterThan(1, strlen($game['Statistics']['Rating']));
        $this->assertGreaterThan(1, strlen($game['Statistics']['Beat']));
    }
}
