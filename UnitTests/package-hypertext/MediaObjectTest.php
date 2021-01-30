<?php namespace ZN\Hypertext;

use Html;

class MediaObjectTest extends \PHPUnit\Framework\TestCase
{
    public function testMediaOjbect4()
    {
        $this->assertStringContainsString
        (
            '<div class="media border p-3">', 
            (string) Html::mediaObject4('micheal_avatar.png', 'Micheal', 'Good job!', 'February 19, 2016')
        );
    }

    public function testMediaObjectReply()
    {
        $this->assertStringContainsString
        (
            '<h4>John <small><i>February 20, 2016</i></small></h4>', 
            (string) Html::mediaObjectReply(function()
            {            
                echo Html::mediaObject4('john_avatar.png', 'John', 'Yes.', 'February 20, 2016');
                echo Html::mediaObject4('alax_avatar.png', 'Alex', 'No!', 'February 21, 2016');
            
            })->mediaObject4('avatar.png', 'Micheal', 'Good job!', 'February 19, 2016')
        );
    }
}