<?php namespace ZN\Compression;

use Compress;

class DoTest extends CompressionExtends
{
    public function testDo()
    {
        $compress = Compress::do('Example Data');

        $this->assertIsString($compress);
    }
}