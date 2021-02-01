<?php namespace ZN\Filesystem;

use File;
use Date;

class FileChangeDateTest extends FilesystemExtends
{
    public function testChangeDate()
    {
        $this->assertTrue(Date::check(File::changeDate(self::file), 'Y'));
    }
}