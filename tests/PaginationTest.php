<?php

use IvanKayzer\HowLongToBeat\HowLongToBeat;

class PaginationTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function last_page_is_equal_to_current_page_if_there_is_only_one_page()
    {
        $hl2b = new HowLongToBeat();

        $results = $hl2b->search('The Witcher 3');

        $this->assertEquals(1, $results['Pagination']['Current Page']);
        $this->assertEquals(1, $results['Pagination']['Last Page']);
    }

    /** @test */
    public function last_page_is_not_equal_to_current_page_if_there_are_more_pages()
    {
        $hl2b = new HowLongToBeat();

        $results = $hl2b->search('Lego');

        $this->assertEquals(1, $results['Pagination']['Current Page']);
        $this->assertEquals(4, $results['Pagination']['Last Page']);
    }
}
