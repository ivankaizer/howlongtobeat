<?php

namespace IvanKayzer\HowLongToBeat;

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
        $this->client = $client ?? HttpClientCreator::create();
    }

    /**
     * @param $query
     * @param int $page
     * @return array
     */
    public function search($query, $page = 1)
    {
        $crawler = $this->client->request('POST', "https://howlongtobeat.com/search_results?page={$page}", [
            'queryString' => $query,
            't' => 'games',
            'sorthead' => 'popular',
            'sortd' => 'Normal Order',
        ]);

        $results = $crawler->filter('.back_darkish')->each(function ($node) {
            $node = new ListNodeCrawler($node);

            return [
                'ID' => $node->getId(),
                'Image' => $node->getImage(),
                'Title' => $node->getTitle(),
                'Time' => $node->getTime()
            ];
        });

        $pageCount = $crawler->filter('.search_list_page:last-child');

        return [
            'Results' => $results,
            'Pagination' => [
                'Current Page' => $page,
                'Last Page' => $pageCount->count() ? (int)$pageCount->text() : $page
            ]
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function get($id)
    {
        $crawler = $this->client->request('GET', 'https://howlongtobeat.com/game?id=' . $id);

        $node = new PageNodeCrawler($crawler, $id);

        $gameInfo = [
            'ID' => $id,
            'Title' => $node->getTitle(),
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
