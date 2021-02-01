<?php namespace ZN\Filesystem;

use Folder;

class CreateFolderTest extends FilesystemExtends
{
    public function testCreate()
    {
        Folder::create($directory = self::directory . 'create');

        $this->assertDirectoryExists($directory);

        Folder::delete($directory);
    }
}