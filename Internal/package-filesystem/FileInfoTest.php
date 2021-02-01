<?php namespace ZN\Filesystem;

use File;
use Date;

class FileInfoTest extends FilesystemExtends
{
    public function testInfo()
    {
        File::write($file = self::directory . 'info.txt', 'test');

        $this->assertSame('info.txt', File::info($file)->basename);
    }
}