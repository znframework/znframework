<?php namespace ZN\Filesystem;

use Folder;

class FolderInfoTest extends FilesystemExtends
{
    public function testGetFileInfo()
    {
        $this->assertIsArray((Folder::fileInfo(self::directory)));
    }
}