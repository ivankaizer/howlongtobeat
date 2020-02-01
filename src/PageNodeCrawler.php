<?php

namespace ivankayzer\HowLongToBeat;

use Symfony\Component\DomCrawler\Crawler;

class PageNodeCrawler
{
    /**
     * @var Crawler
     */
    private $node;

    /**
     * ListNodeCrawler constructor.
     * @param Crawler $node
     */
    public function __construct(Crawler $node)
    {
        $this->node = $node;
    }

    /**
     * @return Crawler
     */
    public function getNode()
    {
        return $this->node;
    }

    public function getImage()
    {
        return $this->node->filter('.game_image img')->attr('src');
    }

    public function getDescription()
    {
        return $this->node->filter('.in.back_primary > p')->text();
    }

    public function getStatistics()
    {
        $stats = $this->node->filter('.profile_details ul li')->each(function (Crawler $node) {
            list($value, $key) = explode(' ', $node->text());
            $value = Utilities::convertAbbreviationsToNumber($value);
            return [$key => $value];
        });

        return Utilities::flattenArray($stats);
    }

    public function getGameTimes()
    {
        return $this->node->filter('.game_times')->each(function (Crawler $node) {
            return [
                'Main Story' => $node->filter('li:nth-child(1) div')->text(),
                'Main + Extras' => $node->filter('li:nth-child(2) div')->text(),
                'Completionist' => $node->filter('li:nth-child(3) div')->text(),
                'All Styles' => $node->filter('li:nth-child(4) div')->text(),
            ];
        });
    }

    public function getGameTimeTables()
    {
        $tables = [];

        $this->node->filter('.game_main_table')->each(function (Crawler $node) use (&$tables) {
            $key = $node->filter('thead > tr > td:first-child')->text();
            $columns = $node->filter('thead > tr > td:not(:first-child)')->each(function (Crawler $n) {
                return $n->text();
            });
            $rows = $node->filter('tbody > tr > td:first-child')->each(function (Crawler $n) {
                return $n->text();
            });
            $tables[$key] = [];

            foreach ($rows as $i => $row) {
                $node->filter(".spreadsheet")->each(function (Crawler $n) use ($key, &$tables, $columns) {
                    $title = $n->filter('td:first-child')->text();
                    $data = $n->filter('td:not(:first-child)')->each(function (Crawler $nn) use ($key, &$tables, $columns) {
                        return Utilities::convertAbbreviationsToNumber($nn->text());
                    });
                    $tables[$key][$title] = array_combine($columns, $data);
                });
            }
        });

        return $tables;
    }

    public function getDeveloper()
    {
        return $this->getProfileInfo()['Developer'];
    }

    public function getPublisher()
    {
        return $this->getProfileInfo()['Publisher'];
    }

    public function getLastUpdate()
    {
        return $this->getProfileInfo()['Updated'];
    }

    public function getPlayableOn()
    {
        return $this->getProfileInfo()['Playable On'];
    }

    public function getGenres()
    {
        return $this->getProfileInfo()['Genre'];
    }

    protected function getProfileInfo()
    {
        $labels = [
            'Developers' => 'Developer',
            'Publishers' => 'Publisher',
            'Genres' => 'Genre',
        ];

        static $details = null;

        if (is_null($details)) {
            $details = $this->node->filter('.profile_info')->each(function (Crawler $node) use ($labels) {
                $key = str_replace(':', '', $node->filter('strong')->text());
                $key = isset($labels[$key]) ? $labels[$key] : $key;
                return [
                    $key => explode(': ', $node->text())[1]
                ];
            });

            $details = Utilities::flattenArray($details);
        }

        return $details;
    }
}