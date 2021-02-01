<?php namespace ZN\Filesystem;

use Upload;
use ZN\Base;

class UploadTest extends FilesystemExtends
{
    public function testCreateFile()
    {
        $file = tempnam(sys_get_temp_dir(), 'Tux');

        $_FILES['file']['name']     = basename($file);
        $_FILES['file']['type']     = 'text/plain';
        $_FILES['file']['size']     = 1;
        $_FILES['file']['tmp_name'] = sys_get_temp_dir();
        $_FILES['file']['error']    = UPLOAD_ERR_OK;
    }

    public function testInvalidExtension()
    {
        Upload::extensions('png', 'jpg')->start('file', self::directory);

        $this->assertSame('Invalid file extension!', Upload::error());
    }

    public function testInvalidMime()
    {
        Upload::mimes('image/png')->start('file', self::directory);

        $this->assertSame('Invalid mime type!', Upload::error());
    }

    public function testConvertName()
    {
        Upload::convertName('my')->start('file', self::directory);

        $this->assertStringEndsWith('my.tmp', Base::suffix(Upload::info()->path, '.tmp'));
    }

    public function testEncode()
    {
        Upload::encode(false)->convertName('my')->start('file', self::directory);

        $this->assertSame('my.tmp', Base::suffix(basename(Upload::info()->path), '.tmp'));

    }

    public function testEncodeLength()
    {
        Upload::encode('md5')->encodeLength(4)->convertName('my')->start('file', self::directory);

        #xxxx-my.tmp = 11
        $this->assertSame(11, strlen(Base::suffix(basename(Upload::info()->path), '.tmp')));

    }

    public function testPrefix()
    {
        Upload::encode(false)->prefix('test.')->convertName('my')->start('file', self::directory);

        $this->assertSame('test.my.tmp', Base::suffix(basename(Upload::info()->path), '.tmp'));
    }

    public function testMaxsize()
    {
        Upload::maxsize(1000)->start('file', self::directory);

        $this->assertSame('Determine the maximum file size has been exceeded!', Upload::error());
    }

    public function testUploadIsFile()
    {
        $this->assertTrue(Upload::isFile('file'));
        $this->assertFalse(Upload::isFile('file2'));
    }

    public function testInfo()
    {
        $this->assertIsObject(Upload::info());
    }   
}