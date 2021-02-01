<?php namespace ZN\Hypertext;

use Html;

class TooltipTest extends \PHPUnit\Framework\TestCase
{
    public function testTooltip()
    {
        $this->assertStringContainsString
        (
            ' data-toggle="tooltip"', 
            (string) Html::class('btn btn-danger')->tooltip('right', 'ZN Framework')->button('NAME') .
                     Html::tooltipEvent('all', ['delay' => 100])
        );
    }
}