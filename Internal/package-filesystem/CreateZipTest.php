<?php namespace ZN\Filesystem;

use File;

class CreateZipTest extends FilesystemExtends
{
    public function testCreateZip()
    {
        File::create($file1 = self::directory . '1.txt');
        File::create($file2 = self::directory . '2.txt');
        
        File::createZip($zipFile = self::directory . 'example.zip', [$file1, $file2]);

        $this->assertFileExists($zipFile);

        File::delete($file1);
        File::delete($file2);
        File::delete($zipFile);
    }
}