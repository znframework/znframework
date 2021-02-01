<?php namespace ZN\Filesystem;

use File;

class ZipExtractTest extends FilesystemExtends
{
    public function testZipExtract()
    {
        File::create($file1 = self::directory . 'zip-file-1.txt');
        File::create($file2 = self::directory . 'zip-file-2.txt');
        File::createZip($zipFile = self::directory . 'example.zip', [$file1, $file2]);
        File::zipExtract($zipFile, $directory = self::directory . 'extract/');

        $this->assertDirectoryExists($directory);
    }
}