<?php namespace ZN\Filesystem;

use File;

class CreateZipTest extends FilesystemExtends
{
    public function testCreateZip()
    {
        File::create(self::directory . 'zip-file-1.txt');
        File::create(self::directory . 'zip-file-2.txt');

        File::createZip($zipFile = self::directory . 'example.zip', [self::directory . 'zip-file-1.txt', self::directory . 'zip-file-2.txt']);

        $this->assertFileExists($zipFile);
    }
}