<?php namespace ZN\EventHandler;

use Buffer;
use Events;

class EventHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function testRun()
    {
        Events::callback(function()
        {
            echo 3;
        
        }, 3)::callback(function()
        {
            echo 1;

        }, 1)::callback(function()
        {
            echo 2;

        }, 2)::create('FileProcess');

        $this->assertSame('123', Buffer::callback(function()
        {
            Events::run('FileProcess');
        }));   

        $this->assertSame('123', Buffer::callback(function()
        {
            Events::FileProcess();
        }));  
    }

    public function testGet()
    {
        $this->assertSame(3, count(Events::get('FileProcess')));
        
        $this->assertSame('1', Buffer::callback(function()
        {
            Events::get('FileProcess', 1)();
        }));  
    }

    public function testRemove()
    {
        Events::remove('FileProcess', 3);

        $this->assertSame('12', Buffer::callback(function()
        {
            Events::run('FileProcess');
        }));   
    }

    public function testRunWithParameters()
    {
        Events::callback(function($param)
        {
            echo $param;

        })::create('param');  

        $this->assertSame('myParam', Buffer::callback(function()
        {
            Events::run('param', ['myParam']);
        }));  
    }
}