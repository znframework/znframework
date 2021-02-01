<?php namespace ZN\Filesystem;

use File;

class FileRowCountTest extends FilesystemExtends
{
    public function testRowCount()
    {
        File::write($file = self::directory . 'row-count.txt', "test\nexample");

        $this->assertSame(2, File::rowCount($file));
    }
}