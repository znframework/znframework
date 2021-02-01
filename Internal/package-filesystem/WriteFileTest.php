<?php namespace ZN\Filesystem;

use File;

class WriteFileTest extends FilesystemExtends
{
    public function testWrite()
    {
        File::write(self::file, 'test');

        $this->assertFileExists(self::file);

        File::delete(self::file);
    }
}