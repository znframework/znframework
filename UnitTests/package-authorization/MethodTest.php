<?php namespace ZN\Authorization;

use Permission;

class MethodTest extends AuthorizationExtends
{
    public function testPostMethodUpdateProcess()
    {
        $_POST = [];
        $_POST['update'] = true;

        $this->assertTrue (Permission::post(1));
        $this->assertTrue (Permission::post(2));
        $this->assertFalse(Permission::post(3));
        $this->assertFalse(Permission::post(4));
    }

    public function testPostMethodDeleteProcess()
    {
        $_POST = [];
        $_POST['delete'] = true;

        $this->assertTrue (Permission::post(1));
        $this->assertFalse(Permission::post(2));
        $this->assertFalse(Permission::post(3));
        $this->assertFalse(Permission::post(4));
    }

    public function testPostMethodCreateProcess()
    {
        $_POST = [];
        $_POST['create'] = true;

        $this->assertTrue (Permission::post(1));
        $this->assertTrue (Permission::post(2));
        $this->assertTrue (Permission::post(3));
        $this->assertFalse(Permission::post(4));
    }
}