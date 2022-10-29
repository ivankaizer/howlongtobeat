<?php

namespace IvanKayzer\HowLongToBeat;

class JSONExtractor implements Extractor
{
    /**
     * @var array
     */
    protected $game;

    /**
     * @var Utilities
     */
    protected $utilities;

    public function __construct(array $game, Utilities $utilities = null)
    {
        $this->game = $game;
        $this->utilities = $utilities ?? new Utilities();
    }

    public function extract(): array
    {
        return [
            'ID' => $this->game['game_id'],
            'Image' => $this->getImage(),
            'Title' => $this->game['game_name'],
            'Description' => $this->game['profile_summary'] ?? null,
            'Developer' => $this->game['profile_dev'] ?? null,
            'Publisher' => $this->game['profile_pub'] ?? null,
            'Last Update' => $this->game['added_stats'] ?? null,
            'Playable On' => $this->game['profile_platform'] ?? null,
            'Genres' => $this->game['profile_genre'] ?? null,
            'Statistics' => $this->getStats(),
            'Summary' => $this->getSummary()
        ];
    }

    private function getImage(): string
    {
        if (!isset($this->game['game_image']) || !$this->game['game_image']) {
            return '';
        }

        return 'https://howlongtobeat.com/games/' . $this->game['game_image'];
    }

    private function getSummary(): array
    {
        return [
            'Main Story' => $this->utilities->formatTimeSeconds($this->game['comp_main'] ?? null),
            'Main + Extra' => $this->utilities->formatTimeSeconds($this->game['comp_plus'] ?? null),
            'Completionist' => $this->utilities->formatTimeSeconds($this->game['comp_100'] ?? null),
            'All Styles' => $this->utilities->formatTimeSeconds($this->game['comp_all'] ?? null)
        ];
    }

    private function getStats(): array
    {
        return [
            'Playing' => $this->game['count_playing'] ?? 0,
            'Backlogs' => $this->game['count_backlog'] ?? 0,
            'Replays' => $this->game['count_replay'] ?? 0,
            'Retired' => $this->game['count_retired'] ?? 0,
            'Rating' => ($this->game['review_score'] ?? 0) . '%',
            'Beat' => $this->game['count_comp'] ?? 0,
        ];
    }
}
