<?php namespace ZN\Filesystem;

use Folder;

class CreateFolderTest extends FilesystemExtends
{
    public function testCreate()
    {
        Folder::create($directory = self::directory . 'example');

        $this->assertDirectoryExists($directory);
    }
}