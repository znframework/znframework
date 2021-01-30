<?php namespace ZN\Hypertext;

use Html;

class BreadcrumbTest extends \PHPUnit\Framework\TestCase
{
    public function testSetURI()
    {
        $this->assertStringContainsString
        (
            '<nav aria-label="breadcrumb">', 
            (string) Html::breadcrumb('Products/Asus/Computer')
        );
    }

    public function testSetAutoURI()
    {
        $this->assertStringContainsString
        (
            '<nav aria-label="breadcrumb">', 
            (string) Html::breadcrumb(NULL, 2)
        );
    }
}