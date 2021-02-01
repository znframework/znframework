<?php namespace ZN\Filesystem;

use File;
use Date;

class FileCreateDateTest extends FilesystemExtends
{
    public function testCreateDate()
    {
        File::create(self::file);

        $this->assertTrue(Date::check(File::createDate(self::file), 'Y'));

        File::delete(self::file);
    }
}