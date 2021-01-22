<?php namespace ZN\Authorization;

use ZN\Config;

class MethodTest extends \PHPUnit\Framework\TestCase
{
    public function testPost()
    {
        $class = new Method;

        $this->assertFalse($class->post(1));

        Config::set('Auth', 'method', 
        [
            '1' => 'all',
            '2' => ['noperm' => ['delete']],
            '3' => ['noperm' => ['add', 'update', 'delete']]
        ]);
        
        $this->assertTrue($class->post(1));
    }

    public function testGet()
    {
        $class = new Method;

        $this->assertTrue($class->get(1));
    }

    public function testRequest()
    {
        $class = new Method;

        $this->assertTrue($class->request(1));
    }
}