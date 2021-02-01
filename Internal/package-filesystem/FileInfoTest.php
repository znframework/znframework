<?php namespace ZN\Filesystem;

use File;

class FileInfoTest extends FilesystemExtends
{
    public function testInfo()
    {
        File::write($file = self::file, 'test');

        $this->assertSame('test.txt', File::info($file)->basename);

        File::delete(self::file);
    }
}