<?php namespace ZN\Filesystem;

use Folder;

class FolderAllFilesTest extends FilesystemExtends
{
    public function testAllFiles()
    {
        $directory = self::directory . 'files/';

        Folder::create($directory);

        File::create($directory . 'files1.txt');
        File::create($directory . 'files2.txt');
        File::create($directory . 'files3');

        $files = Folder::allFiles($directory);

        $this->assertEquals(3, count($files));

        Folder::delete($directory);
    }
}