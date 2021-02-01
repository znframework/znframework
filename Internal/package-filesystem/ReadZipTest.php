<?php namespace ZN\Filesystem;

use File;

class ReadZipTest extends FilesystemExtends
{
    public function testReadZip()
    {
        File::create($file1 = self::directory . 'zip-file-1.txt');
        File::create($file2 = self::directory . 'zip-file-2.txt');
        File::createZip($zipFile = self::directory . 'example.zip', [$file1, $file2]);

        $zipFiles = File::readZip($zipFile);

        $this->assertEquals([$file1, $file2], $zipFiles);
    }
}