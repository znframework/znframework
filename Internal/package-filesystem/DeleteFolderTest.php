<?php namespace ZN\Filesystem;

use Folder;

class DeleteFolderTest extends FilesystemExtends
{
    public function testDelete()
    {
        Folder::create(self::dir);

        $this->assertTrue(Folder::delete(self::dir));
    }
}