<?php namespace ZN\Hypertext;

use Style;
use Buffer;

class StyleTest extends \PHPUnit\Framework\TestCase
{
    public function testOpen()
    {
        $this->assertStringContainsString
        (
            '<style type="text/css">', 
            Style::open()
        );
    }
    
    public function testClose()
    {
        $this->assertStringContainsString
        (
            '</style', 
            Style::close()
        );
    }

    public function testType()
    {
        $this->assertStringContainsString
        (
            '<style type="application/css">', 
            Style::type('application/css')->open()
        );
    }

    public function testLibrary()
    {
        $this->assertStringContainsString
        (
            'bootstrap.min.css', 
            Buffer::callback(function(){ Style::library('bootstrap')->open(); })
        );
    }
}