<?php namespace ZN\Hypertext;

use Html;

class AlertTest extends \PHPUnit\Framework\TestCase
{
    public function testString()
    {
        $this->assertStringContainsString
        (
            '<div role="alert" class="alert alert-danger">', 
            (string) Html::alert('danger', 'Hi!')
        );
    }

    public function testCall()
    {
        $this->assertStringContainsString
        (
            '<div role="alert" class="alert alert-danger">', 
            (string) Html::alertDanger('Hi!')
        );
    }

    public function testDismissButton()
    {
        $this->assertStringContainsString
        (
            '<button class="close" data-dismiss="alert" aria-label="Close" type="button">', 
            (string) Html::dismissButton()->alertWarning('Hi!')
        );
    }

    public function testDismissFade()
    {
        $this->assertStringContainsString
        (
            'alert-dismissible fade', 
            (string) Html::dismissFade()->dismissButton()->alertInfo('Hi!')
        );
    }
}