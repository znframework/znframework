<?php namespace ZN\Filesystem;

use File;
use Date;

class FileCreateDateTest extends FilesystemExtends
{
    public function testCreateDate()
    {
        $this->assertTrue(Date::check(File::createDate(self::file), 'Y'));
    }
}