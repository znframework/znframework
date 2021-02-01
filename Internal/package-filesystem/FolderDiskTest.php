<?php namespace ZN\Filesystem;

use Folder;

class FolderDiskTest extends FilesystemExtends
{
    public function testDisk()
    {
        Folder::create($directory = self::directory . 'disk');

        $this->assertIsFloat(Folder::disk($directory));
        $this->assertIsFloat(Folder::disk($directory, 'total'));

        Folder::delete($directory);
    }
}