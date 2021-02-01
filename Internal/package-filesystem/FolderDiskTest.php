<?php namespace ZN\Filesystem;

use Folder;

class FolderDiskTest extends FilesystemExtends
{
    public function testDisk()
    {
        Folder::create(self::dir);

        $this->assertIsFloat(Folder::disk(self::dir));
        $this->assertIsFloat(Folder::disk(self::dir, 'total'));

        Folder::delete(self::dir);
    }
}