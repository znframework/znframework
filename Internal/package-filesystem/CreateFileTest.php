<?php namespace ZN\Filesystem;

use File;

class CreateFileTest extends FilesystemExtends
{
    public function testCreate()
    {
        File::create(self::file);

        $this->assertFileExists(self::file);

        File::delete(self::file);
    }
}