<?php namespace ZN\Filesystem;

use Folder;

class FolderPermissionTest extends FilesystemExtends
{
    public function testPermission()
    {
        Folder::create(self::dir);

        Folder::permission(self::dir, 0777);

        $this->assertTrue(Folder::info(self::dir)->writable);

        Folder::delete(self::dir);
    }
}