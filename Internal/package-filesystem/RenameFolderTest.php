<?php namespace ZN\Filesystem;

use Folder;

class RenameFolderTest extends FilesystemExtends
{
    public function testRename()
    {
        Folder::create($directory = self::directory . 'renameold');

        Folder::rename($directory, $renameDirectory = self::directory . 'renamenew');

        $this->assertDirectoryExists($renameDirectory);

        Folder::delete($directory); Folder::delete($renameDirectory);
    }
}