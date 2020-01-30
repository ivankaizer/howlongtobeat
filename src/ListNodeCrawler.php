<?php

namespace ivankayzer\HowLongToBeat;

use Symfony\Component\DomCrawler\Crawler;

class ListNodeCrawler
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

    /**
     * @return string|string[]
     */
    public function getId()
    {
        return str_replace('game?id=', '', $this->node->filter('.search_list_image a')->attr('href'));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->node->filter('.search_list_details h3')->text();
    }

    /**
     * @return string|null
     */
    public function getMainStoryTime()
    {
        return $this->formatTime($this->node->filter('.search_list_details_block .search_list_tidbit:nth-child(2)')->text());
    }

    /**
     * @return string|null
     */
    public function getMainAndExtraTime()
    {
        return $this->formatTime($this->node->filter('.search_list_details_block .search_list_tidbit:nth-child(4)')->text());
    }

    /**
     * @return string|null
     */
    public function getCompletionistTime()
    {
        return $this->formatTime($this->node->filter('.search_list_details_block .search_list_tidbit:nth-child(6)')->text());
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->node->filter('.search_list_image img')->attr('src');
    }

    /**
     * @param string $time
     * @return null|string
     */
    protected function formatTime($time)
    {
        return $time === '--' ? null : $time;
    }
}