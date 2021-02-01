<?php namespace ZN\Filesystem;

use File;

class RenameFileTest extends FilesystemExtends
{
    public function testRename()
    {
        File::rename(self::file, $file = self::directory . 'rename-file.txt');

        $this->assertFileExists($file);
    }
}