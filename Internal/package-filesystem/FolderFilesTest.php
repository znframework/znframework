<?php namespace ZN\Filesystem;

use File;
use Folder;

class FolderFilesTest extends FilesystemExtends
{
    public function testFiles()
    {
        $directory = self::directory . 'files/';

        Folder::create($directory);

        File::create($directory . 'files1.txt');
        File::create($directory . 'files2.txt');
        File::create($directory . 'files3');

        $files = Folder::files($directory);

        $this->assertEquals(3, count($files));

        Folder::delete($directory);
    }

    public function testFilesExtensionParameter()
    {
        $directory = self::directory . 'filesExtensions/';

        Folder::create($directory);

        File::create($directory . 'files1.txt');
        File::create($directory . 'files2.txt');
        File::create($directory . 'files3');

        $files = Folder::files($directory, ['txt']);

        $this->assertEquals(2, count($files));

        Folder::delete($directory);
    }
}