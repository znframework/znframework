<?php namespace ZN\Hypertext;

use Html;

class PopoverTest extends \PHPUnit\Framework\TestCase
{
    public function testPopover()
    {
        $this->assertStringContainsString
        (
            ' data-toggle="popover"', 
            (string) Html::class('btn btn-danger')->popover('right', 'ZN Framework')->button('NAME') .
                     Html::popoverEvent('all', ['delay' => 100])
        );
    }
}