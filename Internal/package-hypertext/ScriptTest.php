<?php namespace ZN\Hypertext;

use Script;
use Buffer;

class ScriptTest extends \PHPUnit\Framework\TestCase
{
    public function testOpen()
    {
        $this->assertStringContainsString
        (
            '<script type="text/javascript">', 
            Script::open()
        );
    }
    
    public function testClose()
    {
        $this->assertStringContainsString
        (
            '</script>', 
            Script::close()
        );
    }

    public function testType()
    {
        $this->assertStringContainsString
        (
            '<script type="application/javascript">', 
            Script::type('application/javascript')->open()
        );
    }

    public function testLibrary()
    {
        $this->assertStringContainsString
        (
            '<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>', 
            Buffer::callback(function(){ Script::library('jquery', 'bootstrap')->open(); })
        );
    }

    public function testCompress()
    {
        $this->assertStringContainsString
        (
            'eval(function(p,a,c,k,e,d)', 
            Script::compress(function(){ echo 'console.log(data)'; })
        );
    }
}