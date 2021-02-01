<?php namespace ZN\Filesystem;

use File;

class FileSizeTest extends FilesystemExtends
{
    public function testSize()
    {
        File::write($file = self::directory . 'size.txt', 'test');

        $this->assertSame(4, (int) File::size(self::file));
    }
}