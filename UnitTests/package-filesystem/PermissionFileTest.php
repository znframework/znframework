<?php namespace ZN\Filesystem;

use File;

class PermissionFileTest extends FilesystemExtends
{
    public function testPermission()
    {
        File::create($file = self::directory . 'permission-file.txt');

        File::permission($file, 644);

        $this->assertFalse(File::info($file)->executable);
    }
}