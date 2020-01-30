<?php

namespace ivankayzer\HowLongToBeat;

use Goutte\Client;

class HowLongToBeat
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function search($query)
    {
        $crawler = $this->client->request('POST', 'https://howlongtobeat.com/search_results?page=1', [
            'queryString' => $query,
            't' => 'games',
            'sorthead' => 'popular',
            'sortd' => 'Normal Order',
        ]);

        return $crawler->filter('.back_darkish')->each(function ($node) {
            $node = new ListNodeCrawler($node);

            return [
                'id' => $node->getId(),
                'image' => $node->getImage(),
                'name' => $node->getName(),
                'main_story' => $node->getMainStoryTime(),
                'main_and_extra' => $node->getMainAndExtraTime(),
                'completionist' => $node->getCompletionistTime(),
            ];
        });
    }

    public function get($id)
    {
        return [
            'id' => $id,
            'image' => '',
            'description' => '',
            'developer' => '',
            'publisher' => '',
            'playable_on' => [],
            'genres' => [],
            'stats' => [],
            'release_date' => [
                'na' => '',
                'eu' => '',
            ],
            'last_update' => '',
            'general' => [
                'main_story' => '',
                'main_and_extra' => '',
                'completionist' => '',
                'all_styles' => '',
            ],
            'single_player' => [
                'main_story' => [
                    'polled' => '',
                    'average' => '',
                    'median' => '',
                    'rushed' => '',
                    'leisure' => '',
                ],
                'main_and_extra' => [
                    'polled' => '',
                    'average' => '',
                    'median' => '',
                    'rushed' => '',
                    'leisure' => '',
                ],
                'completionists' => [
                    'polled' => '',
                    'average' => '',
                    'median' => '',
                    'rushed' => '',
                    'leisure' => '',
                ],
                'all_playstyles' => [
                    'polled' => '',
                    'average' => '',
                    'median' => '',
                    'rushed' => '',
                    'leisure' => '',
                ]
            ],
            'speedrun' => [],
            'multiplayer' => [],
            'platform' => [],
        ];
    }
}