<?php namespace ZN\Compression;

use File;
use Compress;

class WriteTest extends CompressionExtends
{
    public function testWrite()
    {
        Compress::write(self::file, 'Example Data');

        $this->assertIsString(File::read(self::file));

        File::delete(self::file);
    }
}