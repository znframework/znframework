<?php namespace ZN\Filesystem;

use File;

class PermissionFileTest extends FilesystemExtends
{
    public function testPermission()
    {
        File::create(self::file);

        File::permission(self::file, 644);

        $this->assertFalse(File::info(self::file)->executable);

        File::delete(self::file);
    }
}