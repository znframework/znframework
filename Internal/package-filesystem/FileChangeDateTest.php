<?php namespace ZN\Filesystem;

use File;
use Date;

class FileChangeDateTest extends FilesystemExtends
{
    public function testChangeDate()
    {
        File::create(self::file);

        $this->assertTrue(Date::check(File::changeDate(self::file), 'Y'));

        File::delete(self::file);
    }
}