<?php namespace ZN\Pagination;

use URL;
use Pagination;

class PaginationTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $this->assertStringContainsString('Home/main/40', Pagination::create());
    }

    public function testURL()
    {
        $this->assertStringContainsString('product/list/40', Pagination::url('product/list')->create());
    }

    public function testStart()
    {
        $this->assertStringContainsString
        (
            '<li class="page-item active"><a href="' . URL::site('Home/main/20') . '" class="page-link">3</a></li>', 
            Pagination::url('Home/main')->start(20)->create()
        );
    }

    public function testLimit()
    {
        $this->assertStringContainsString
        (
            '<a href="' . URL::site('Home/main/45') . '" class="page-link">10</a>', 
            Pagination::limit(5)->create()
        );
    }

    public function testTotalRows()
    {
        $this->assertStringContainsString
        (
            '<a href="' . URL::site('Home/main/40') . '" class="page-link">3</a>', 
            Pagination::limit(20)->totalRows(45)->create()
        );
    }

    public function testCountLinks()
    {
        $this->assertStringContainsString
        (
            '<a href="' . URL::site('Home/main/10') . '" class="page-link">2</a>', 
            Pagination::countLinks(2)->limit(10)->totalRows(100)->create()
        );
    }
    
    public function testLinkNames()
    {
        $this->assertStringContainsString
        (
            '<a href="' . URL::site('Home/main/10') . '" class="page-link">[ next ]</a></li>', 
            Pagination::linkNames('[ prev ]', '[ next ]', '[+ first +]', '[+ last +]')->create()
        );
    }

    public function testStyle()
    {
        $this->assertStringContainsString
        (
            '<li class="page-item active" style="font-size:30px;"><a href="' . URL::site('Home/main/0') . '" class="page-link">1</a></li><li style="color:green;"><a href="' . URL::site('Home/main/15') . '" class="page-link">2</a></li>', 
            Pagination::limit(15)
               ->totalRows(200)
               ->countLinks(3)
               ->linkNames('[ prev ]', '[ next ]', '[+ first +]', '[+ last +]')
               ->style(['links' => 'color:green;', 'current' => 'font-size:30px;'])
               ->create()
        );
    }

    public function testOutput()
    {
        $this->assertStringContainsString
        (
            '<ul class="pagination">', 
            Pagination::output('bootstrap')
               ->limit(15)
               ->totalRows(75)
               ->countLinks(5)
               ->create()
        );
    }
}