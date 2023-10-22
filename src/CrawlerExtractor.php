<?php

namespace Askancy\HowLongToBeat;

use Symfony\Component\DomCrawler\Crawler;

class CrawlerExtractor implements Extractor
{
    /**
     * @var Crawler
     */
    protected $node;

    /**
     * @var Utilities|null
     */
    protected $utilities;

    public function __construct(Crawler $node, Utilities $utilities = null)
    {
        $this->node = $node;
        $this->utilities = $utilities ?? new Utilities();
    }

    public function extract(): array
    {
        $utils = $this->utilities;

        $tables = [];

        $this->node->filter('[class^=GamePlatformTable_game_main_table]')->each(function (Crawler $node) use (&$tables, $utils) {
            $key = $node->filter('thead > tr > td:first-child')->text();
            $columns = $node->filter('thead > tr > td:not(:first-child)')->each(function (Crawler $n) {
                return $n->text();
            });
            $rows = $node->filter('tbody > tr > td:first-child')->each(function (Crawler $n) {
                return $n->text();
            });
            $tables[$key] = [];

            foreach ($rows as $row) {
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
}
