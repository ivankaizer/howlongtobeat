<?php

namespace IvanKayzer\HowLongToBeat;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;

class HowLongToBeat
{
    /**
     * @var Client|null
     */
    private $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?? HttpClientCreator::create();
    }

    /**
     * @throws GuzzleException
     */
    public function search($query, int $page = 1): array
    {
        $response = $this->client->post('https://howlongtobeat.com/api/search', [
            'json' =>
                [
                    'searchType' => 'games',
                    'searchTerms' => [
                        $query
                    ],
                    'searchPage' => $page,
                    'size' => 20,
                    'searchOptions' => [
                        'games' => [
                            'userId' => 0,
                            'platform' => '',
                            'sortCategory' => 'popular',
                            'rangeCategory' => 'main',
                            'rangeTime' => [
                                'min' => 0,
                                'max' => 0
                            ],
                            'gameplay' => [
                                'perspective' => '',
                                'flow' => '',
                                'genre' => ''
                            ],
                            'year' => '',
                            'modifier' => ''
                        ],
                        'users' => [
                            'sortCategory' => 'postcount'
                        ],
                        'filter' => '',
                        'sort' => 0,
                        'randomizer' => 0
                    ]
                ]]);

        $searchResult = json_decode($response->getBody()->getContents(), true);

        $games = array_map(
            static function ($game): array {
                return (new JSONExtractor($game))->extract();
            },
            $searchResult['data']
        );

        return [
            'Results' => $games,
            'Pagination' => [
                'Total Results' => $searchResult['count'],
                'Current Page' => $page,
                'Last Page' => $searchResult['pageTotal'],
            ]
        ];
    }

    /**
     * @throws GuzzleException
     */
    public function get($id): array
    {
        $node = new Crawler(
            $this->client->get('https://howlongtobeat.com/game?id=' . $id)->getBody()->getContents()
        );

        $json = json_decode($node->filter('#__NEXT_DATA__')->html(), true);
        $game = $json['props']['pageProps']['game']['data']['game'][0];

        $jsonExtractor = new JSONExtractor($game);
        $crawlerExtractor = new CrawlerExtractor($node);

        return array_merge($jsonExtractor->extract(), $crawlerExtractor->extract());
    }
}
