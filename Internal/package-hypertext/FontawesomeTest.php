<?php namespace ZN\Hypertext;

use Html;

class FontawesomeTest extends \PHPUnit\Framework\TestCase
{
    public function testFaIcon()
    {
        $this->assertStringContainsString
        (
            '<i class="fa fa-pencil fa-lg"></i>', 
            (string) Html::faIcon('pencil', 'lg')
        );
    }

    public function testFasIcon()
    {
        $this->assertStringContainsString
        (
            '<i class="fas fa-pencil fa-lg"></i>', 
            (string) Html::fasIcon('pencil', 'lg')
        );
    }

    public function testFarIcon()
    {
        $this->assertStringContainsString
        (
            '<i class="far fa-pencil fa-lg"></i>', 
            (string) Html::farIcon('pencil', 'lg')
        );
    }

    public function testFadIcon()
    {
        $this->assertStringContainsString
        (
            '<i class="fad fa-pencil fa-lg"></i>', 
            (string) Html::fadIcon('pencil', 'lg')
        );
    }

    public function testFalIcon()
    {
        $this->assertStringContainsString
        (
            '<i class="fal fa-pencil fa-lg"></i>', 
            (string) Html::falIcon('pencil', 'lg')
        );
    }
}