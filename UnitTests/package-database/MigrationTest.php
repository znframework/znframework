<?php namespace ZN\Database;

use Migration;

class MigrationTest extends Test\Constructor
{
    public function testCreate()
    {
        Migration::create('Blog');

        $this->assertTrue(is_file(MODELS_DIR . 'Migrations/Blog.php'));
    }

    public function testCreateVersion()
    {
        Migration::create('Blog', 1);

        $this->assertTrue(is_file(MODELS_DIR . 'Migrations/BlogVersion/001.php'));
    }

    public function testMigrateUp()
    {
        $this->assertIsBool(\MigrateBlog::up());
    }

    public function testMigrateVersionUp()
    {
        $this->assertIsBool(\MigrateBlog001::up());
        $this->assertIsBool(\MigrateBlog::version(1)->up());
    }

    public function testMigrateDown()
    {
        $this->assertIsBool(\MigrateBlog::down());
    }

    public function testMigrateVersionDown()
    {
        $this->assertIsBool(\MigrateBlog001::down());
        $this->assertIsBool(\MigrateBlog::version(1)->down());
    }

    public function testUpAll()
    {
        $this->assertIsBool(Migration::upAll('Blog'));
    }

    public function testUpDown()
    {
        $this->assertIsBool(Migration::downAll('Blog'));
    }

    public function testDelete()
    {
        $this->assertIsBool(Migration::delete('Blog'));
    }

    public function testDeleteVersion()
    {
        $this->assertIsBool(Migration::delete('Blog', 1));
    }

    public function testDeleteAll()
    {
        $this->assertIsBool(Migration::deleteAll());
    }
}