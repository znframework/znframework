<?php namespace ZN\Authorization;

use Permission;

class ProcessTest extends AuthorizationExtends
{
    public function testUpdateProcess()
    {
        Permission::roleId(1);

        $this->assertSame('<b>Update Process</b>', Permission::process('update', '<b>Update Process</b>'));

        Permission::roleId(2);

        $this->assertSame('<b>Update Process</b>', Permission::process('update', '<b>Update Process</b>'));

        Permission::roleId(3);

        $this->assertSame(false, Permission::process('update', '<b>Update Process</b>'));

        Permission::roleId(4);

        $this->assertSame(false, Permission::process('update', '<b>Update Process</b>'));
    }

    public function testDeleteProcess()
    {
        Permission::roleId(1);

        $this->assertSame('<b>Delete Process</b>', Permission::process('delete', '<b>Delete Process</b>'));

        Permission::roleId(2);

        $this->assertSame(false, Permission::process('delete', '<b>Delete Process</b>'));

        Permission::roleId(3);

        $this->assertSame(false, Permission::process('delete', '<b>Delete Process</b>'));

        Permission::roleId(4);

        $this->assertSame(false, Permission::process('delete', '<b>Delete Process</b>'));
    }

    public function testCreateProcess()
    {
        Permission::roleId(1);

        $this->assertSame('<b>Create Process</b>', Permission::process('create', '<b>Create Process</b>'));

        Permission::roleId(2);

        $this->assertSame('<b>Create Process</b>', Permission::process('create', '<b>Create Process</b>'));

        Permission::roleId(3);

        $this->assertSame('<b>Create Process</b>', Permission::process('create', '<b>Create Process</b>'));

        Permission::roleId(4);

        $this->assertSame(false, Permission::process('create', '<b>DeleCreatete Process</b>'));
    }
}