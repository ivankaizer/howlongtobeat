<?php

namespace ivankayzer\HowLongToBeat;

use Goutte\Client;

class HowLongToBeat
{
    protected $client;

    /**
     * HowLongToBeat constructor.
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
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

        $node = new PageNodeCrawler($crawler);

        $gameInfo = [
            'ID' => $id,
            'Image' => $node->getImage(),
            'Description' => $node->getDescription(),
            'Developer' => $node->getDeveloper(),
            'Publisher' => $node->getPublisher(),
            'Last Update' => $node->getLastUpdate(),
            'Playable On' => $node->getPlayableOn(),
            'Genres' => $node->getGenres(),
            'Statistics' => $node->getStatistics(),
            'Summary' => $node->getGameTimes(),
        ];

        return array_merge($gameInfo, $node->getGameTimeTables());
    }
}