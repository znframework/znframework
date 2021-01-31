<?php namespace ZN\Authorization;

use Permission;

class PageTest extends AuthorizationExtends
{
    public function testPageUpdateProcess()
    {
        $_SERVER['PATH_INFO'] = 'update';

        $this->assertTrue (Permission::page(1));
        $this->assertTrue (Permission::page(2));
        $this->assertFalse(Permission::page(3));
        $this->assertFalse(Permission::page(4));
    }

    public function testPageDeleteProcess()
    {
        $_SERVER['PATH_INFO'] = 'delete';

        $this->assertTrue (Permission::page(1));
        $this->assertFalse(Permission::page(2));
        $this->assertFalse(Permission::page(3));
        $this->assertFalse(Permission::page(4));
    }

    public function testPageCreateProcess()
    {
        $_SERVER['PATH_INFO'] = 'create';

        $this->assertTrue (Permission::page(1));
        $this->assertTrue (Permission::page(2));
        $this->assertTrue (Permission::page(3));
        $this->assertFalse(Permission::page(4));
    }

    public function testPageRealpath()
    {
        $this->assertTrue (Permission::realpath('create')->page(3));
        $this->assertFalse(Permission::realpath('delete')->page(3));
        $this->assertFalse(Permission::realpath('update')->page(3));
    }
}