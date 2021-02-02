<?php namespace ZN\Filesystem;

use File;

class ZipExtractTest extends FilesystemExtends
{
    public function testZipExtract()
    {
        File::create($file1 = self::directory . '1.txt');
        File::create($file2 = self::directory . '2.txt');

        File::createZip($zipFile = self::directory . 'example.zip', [$file1, $file2]);
        
        File::zipExtract($zipFile, $directory = self::directory . 'extract/');

        $this->assertDirectoryExists($directory);

        File::delete($file1);
        File::delete($file2);
        File::delete($zipFile);
        
        Folder::delete($directory);
    }
}
