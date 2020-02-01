<?php

namespace ivankayzer\HowLongToBeat;

use Symfony\Component\DomCrawler\Crawler;

class ListNodeCrawler
{
    /**
     * @var Crawler
     */
    protected $node;

    /**
     * @var Utilities
     */
    protected $utilities;

    /**
     * ListNodeCrawler constructor.
     * @param Crawler $node
     * @param Utilities|null $utilities
     */
    public function __construct(Crawler $node, Utilities $utilities = null)
    {
        $this->node = $node;
        $this->utilities = $utilities ?? new Utilities();
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
        return $this->utilities->formatTime($this->node->filter('.search_list_details_block .search_list_tidbit:nth-child(2)')->text());
    }

    /**
     * @return string|null
     */
    public function getMainAndExtraTime()
    {
        return $this->utilities->formatTime($this->node->filter('.search_list_details_block .search_list_tidbit:nth-child(4)')->text());
    }

    /**
     * @return string|null
     */
    public function getCompletionistTime()
    {
        return $this->utilities->formatTime($this->node->filter('.search_list_details_block .search_list_tidbit:nth-child(6)')->text());
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->node->filter('.search_list_image img')->attr('src');
    }
}