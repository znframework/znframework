<?php namespace ZN\Compression;

use File;
use Compress;

class ReadTest extends CompressionExtends
{
    public function testRead()
    {
        Compress::write(self::file, 'Example Data');

        $this->assertEquals('Example Data', Compress::read(self::file));

        File::delete(self::file);
    }
}