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
        $crawler = $this->client->request('GET', 'https://howlongtobeat.com/game?id=' . $id);

        $labels = [
            'Developers' => 'Developer',
            'Publishers' => 'Publisher',
            'Genres' => 'Genre',
        ];

        $profileInfo = $crawler->filter('.profile_info')->each(function ($node) use ($labels) {
            $key = str_replace(':', '', $node->filter('strong')->text());
            $key = isset($labels[$key]) ? $labels[$key] : $key;
            return [
                $key => explode(': ', $node->text())[1]
            ];
        });

        $profileInfo = $this->flattenArray($profileInfo);

        return [
            'id' => $id,
            'image' => $crawler->filter('.game_image img')->attr('src'),
            'description' => $crawler->filter('.in.back_primary > p')->text(),
            'developer' => $profileInfo['Developer'],
            'publisher' => $profileInfo['Publisher'],
            'last_update' => $profileInfo['Updated'],
            'playable_on' => [],
            'genres' => [],
            'stats' => [],
            'release_date' => [
                'na' => '',
                'eu' => '',
            ],
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

    protected function flattenArray($array)
    {
        $return = array();

        array_walk_recursive($array, function($x, $key) use (&$return) { $return[$key] = $x; });

        return $return;
    }
}