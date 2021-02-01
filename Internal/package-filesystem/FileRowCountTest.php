<?php namespace ZN\Filesystem;

use File;

class FileRowCountTest extends FilesystemExtends
{
    public function testRowCount()
    {
        File::write(self::file, "test\nexample");

        $this->assertSame(2, File::rowCount(self::file));

        File::delete(self::file);
    }
}