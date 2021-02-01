<?php namespace ZN\Filesystem;

use File;
use Folder;

class CopyFolderTest extends FilesystemExtends
{
    public function testCopy()
    {
        Folder::create($directory = self::directory . 'copy/');

        File::write($directory . 'copy.txt', 'copy');

        Folder::create($copyDirectory = self::directory . 'copyto/copy');

        Folder::copy($directory, $copyDirectory);

        $this->assertDirectoryExists($copyDirectory);

        Folder::delete($directory); 
        
        Folder::delete($copyDirectory = self::directory . 'copyto/');
    }
}
