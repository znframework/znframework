<?php namespace ZN\Hypertext;

use Html;

class ProgressbarTest extends \PHPUnit\Framework\TestCase
{
    public function testProgressbar()
    {
        $this->assertStringContainsString
        (
            '<div style="height:50px" class="progress">', 
            (string) Html::progressbar('danger', 89, 50)
        );
    }

    public function testProgressbar4()
    {
        $this->assertStringContainsString
        (
            '<div style="height:50px" class="progress">', 
            (string) Html::progressbar4('danger', 89, 50)
        );
    }

    public function testProgressbarAttributes()
    {
        $this->assertStringContainsString
        (
            '<div class="progress-bar progress-bar-danger progress-bar-striped" style="width:18%">', 
            (string) Html::progressbarStriped()->progressbarAnimated()->progressbarDanger(18, 45)
        );
    }
}