<?php namespace ZN\Hypertext;

use Html;

class BadgeTest extends \PHPUnit\Framework\TestCase
{
    public function testBadge()
    {
        $this->assertStringContainsString
        (
            '<span class="label label-danger">', 
            (string) Html::badge('danger', 5)
        );
    }

    public function testBadgeCall()
    {
        $this->assertStringContainsString
        (
            '<span class="label label-danger">', 
            (string) Html::badgeDanger(5)
        );
    }

    public function testBadge4()
    {
        $this->assertStringContainsString
        (
            '<span class="badge badge-danger">', 
            (string) Html::badge4('danger', 5)
        );
    }

    public function testBadge4Call()
    {
        $this->assertStringContainsString
        (
            '<span class="badge badge-danger">', 
            (string) Html::badge4Danger(5)
        );
    }
}