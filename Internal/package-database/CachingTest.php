<?php namespace ZN\Database;

use DB;
use File;

class CachingTest extends DatabaseExtends
{
    public function testCaching()
    {
        DB::caching('8 minutes')->persons()->result();
        DB::caching('8 minutes')->groupBy('name')->persons()->result();

        $this->assertIsString(File::read(STORAGE_DIR . 'Cache/56d1e0d44069532ee503107402b8552b'));
        $this->assertIsString(File::read(STORAGE_DIR . 'Cache/cb40ea2b34d066aeb5080faf9850ccf5'));
    }

    public function testCleanCaching()
    {
        $person = DB::persons();
        
        $person->cleanCaching();

        $person2 = DB::groupBy('name')->persons();

        $person2->cleanCaching();

        $this->assertFalse(is_file(STORAGE_DIR . 'Cache/56d1e0d44069532ee503107402b8552b'));
        $this->assertFalse(is_file(STORAGE_DIR . 'Cache/cb40ea2b34d066aeb5080faf9850ccf5'));
    }
}