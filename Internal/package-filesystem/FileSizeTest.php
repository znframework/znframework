<?php namespace ZN\Filesystem;

use File;

class FileSizeTest extends FilesystemExtends
{
    public function testSize()
    {
        File::write(self::file, 'test');

        $this->assertSame(4, (int) File::size(self::file));

        File::delete(self::file);
    }
}