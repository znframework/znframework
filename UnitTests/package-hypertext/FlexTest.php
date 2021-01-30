<?php namespace ZN\Hypertext;

use Html;

class FlexTest extends \PHPUnit\Framework\TestCase
{
    public function testFlex()
    {
        $this->assertStringContainsString
        (
            '<div class="d-flex bg-secondary">', 
            (string) Html::flex(function()
            {
            
                echo Html::flexItem('Example 1', 'bg-danger');
                echo Html::flexItem('Example 2', 'bg-success');
                echo Html::flexItem('Example 3', 'bg-success');
            
            }, 'bg-secondary')
        );
    }

    public function testItem()
    {
        $this->assertStringContainsString
        (
            '<div class="d-flex bg-secondary flex-flexwrap-wrap">', 
            (string) Html::flexWrap()->flex(function()
            {
                echo Html::flexGrow(1)->flexItem('Example 1', 'bg-danger');
                echo Html::flexItem('Example 2', 'bg-success');
            
            }, 'bg-secondary')
        );
    }
}