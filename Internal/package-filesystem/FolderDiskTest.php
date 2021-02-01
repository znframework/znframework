<?php namespace ZN\Filesystem;

use Folder;

class FolderDiskTest extends FilesystemExtends
{
    public function testDisk()
    {
        $this->assertIsFloat(Folder::disk(self::directory));
        $this->assertIsFloat(Folder::disk(self::directory, 'total'));
    }
}