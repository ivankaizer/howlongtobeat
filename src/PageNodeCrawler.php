<?php

namespace ivankayzer\HowLongToBeat;

use Symfony\Component\DomCrawler\Crawler;

class PageNodeCrawler
{
    /**
     * @var Crawler
     */
    protected $node;

    /**
     * @var Utilities|null
     */
    protected $utilities;

    protected $id;

    /**
     * ListNodeCrawler constructor.
     * @param Crawler $node
     * @param $id
     * @param Utilities|null $utilities
     */
    public function __construct(Crawler $node, $id, Utilities $utilities = null)
    {
        $this->node = $node;
        $this->utilities = $utilities ?? new Utilities();
        $this->id = $id;
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
        return str_replace('...Read More', '', $this->node->filter('.in.back_primary > p')->text());
    }

    public function getStatistics()
    {
        $utils = $this->utilities;

        $stats = $this->node->filter('.profile_details ul li')->each(function (Crawler $node) use ($utils) {
            list($value, $key) = explode(' ', $node->text());
            $value = $utils->convertAbbreviationsToNumber($value);
            return [$key => $value];
        });

        return $utils->flattenArray($stats);
    }

    public function getGameTimes()
    {
        return $this->node->filter('.game_times')->each(function (Crawler $node) {
            return [
                'Main Story' => $this->getGameTimesAtIndex($node, 1),
                'Main + Extras' => $this->getGameTimesAtIndex($node, 2),
                'Completionist' => $this->getGameTimesAtIndex($node, 3),
                'All Styles' => $this->getGameTimesAtIndex($node, 4),
            ];
        });
    }

    public function getGameTimeTables()
    {
        $utils = $this->utilities;

        $tables = [];

        $this->node->filter('.game_main_table')->each(function (Crawler $node) use (&$tables, $utils) {
            $key = $node->filter('thead > tr > td:first-child')->text();
            $columns = $node->filter('thead > tr > td:not(:first-child)')->each(function (Crawler $n) {
                return $n->text();
            });
            $rows = $node->filter('tbody > tr > td:first-child')->each(function (Crawler $n) {
                return $n->text();
            });
            $tables[$key] = [];

            foreach ($rows as $i => $row) {
                $node->filter(".spreadsheet")->each(function (Crawler $n) use ($key, &$tables, $columns, $utils) {
                    $title = $n->filter('td:first-child')->text();
                    $data = $n->filter('td:not(:first-child)')->each(function (Crawler $nn) use ($key, &$tables, $columns, $utils) {
                        return $utils->convertAbbreviationsToNumber($nn->text());
                    });
                    $tables[$key][$title] = array_combine($columns, $data);
                });
            }
        });

        return $tables;
    }

    public function getDeveloper()
    {
        $profileInfo = $this->getProfileInfo();

        return $profileInfo['Developer'] ?? null;
    }

    public function getPublisher()
    {
        $profileInfo = $this->getProfileInfo();

        return $profileInfo['Publisher'] ?? null;
    }

    public function getLastUpdate()
    {
        $profileInfo = $this->getProfileInfo();

        return $profileInfo['Updated'] ?? null;
    }

    public function getPlayableOn()
    {
        $profileInfo = $this->getProfileInfo();

        return $profileInfo['Playable On'] ?? null;
    }

    public function getGenres()
    {
        $profileInfo = $this->getProfileInfo();

        return $profileInfo['Genre'] ?? null;
    }

    public function getTitle()
    {
        return $this->node->filter('.profile_header')->text();
    }

    protected function getProfileInfo()
    {
        $utils = $this->utilities;

        $labels = [
            'Developers' => 'Developer',
            'Publishers' => 'Publisher',
            'Genres' => 'Genre',
        ];

        static $details = [];

        if (!isset($details[$this->id])) {
            $details[$this->id] = $this->node->filter('.profile_info')->each(function (Crawler $node) use ($labels, $utils) {
                $key = str_replace(':', '', $node->filter('strong')->text());
                $key = isset($labels[$key]) ? $labels[$key] : $key;
                return [
                    $key => explode(': ', $node->text())[1]
                ];
            });

            $details[$this->id] = $utils->flattenArray($details[$this->id]);
        }

        return $details[$this->id];
    }

    protected function getGameTimesAtIndex(Crawler $node, $index)
    {
        return $this->utilities->formatTime($node->filter("li:nth-child({$index}) div")->text());
    }
}