<?php namespace ZN\Hypertext;

use Html;

class MoodalboxTest extends \PHPUnit\Framework\TestCase
{
    public function testButton()
    {
        $this->assertStringContainsString
        (
            '<button data-toggle="modal" data-target="#myModal" type="button">', 
            (string) Html::modal('myModal')->button('Open Modal')
        );
    }

    public function testBox()
    {
        $this->assertStringContainsString
        (
            '<div id="myModal" class="modal fade" role="dialog">', 
            (string) Html::modalbox('myModal')
        );
    }

    public function testSize()
    {
        $this->assertStringContainsString
        (
            '<div class="modal-dialog modal-lg">', 
            (string) Html::modalSize('lg')->modalbox('myModal')
        );
    }

    public function testOtherAttributes()
    {
        $this->assertStringContainsString
        (
            '<button type="button" class="close" data-dismiss="modal">', 
            (string) Html::modalDismissButton()->modalHeader('abc')->modalbox('myModal')
        );
    }
}