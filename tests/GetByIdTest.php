<?php

use ivankayzer\HowLongToBeat\HowLongToBeat;

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

        $this->assertEquals(10270, $game['id']);
        $this->assertEquals('https://howlongtobeat.com/gameimages/256px-TW3_Wild_Hunt_logo.png', $game['image']);
        $this->assertEquals('In The Witcher 3 an ancient evil stirs, awakening. An evil that sows terror and abducts the young. An evil whose name is spoken only in whispers: the Wild Hunt. Led by four wraith commanders, this ravenous band of phantoms is the ultimate predator and has been for centuries. Its quarry: humans.', $game['description']);
        $this->assertEquals('CD Projekt RED', $game['developer']);
        $this->assertEquals('CD Projekt, Warner Bros. Interactive Entertainment', $game['publisher']);
        $this->assertEquals('PC, Nintendo Switch, PlayStation 4, Xbox One', $game['playable_on']);
        $this->assertEquals('Third-Person, Action, Open World, Role-Playing', $game['genres']);
    }


    /** @test */
    public function it_returns_game_stats()
    {
        $game = $this->hl2b->get(10270);

        $this->assertGreaterThan(1, strlen($game['stats']['playing']));
        $this->assertGreaterThan(1, strlen($game['stats']['backlogs']));
        $this->assertGreaterThan(1, strlen($game['stats']['replays']));
        $this->assertGreaterThan(1, strlen($game['stats']['retired']));
        $this->assertGreaterThan(1, strlen($game['stats']['rating']));
        $this->assertGreaterThan(1, strlen($game['stats']['beat']));
    }
}