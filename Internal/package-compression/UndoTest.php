<?php namespace ZN\Compression;

use Compress;

class UndoTest extends CompressionExtends
{
    public function testUndo()
    {
        $compress = Compress::do('Example Data');

        $undo = Compress::undo($compress);

        $this->assertIsString('Example Data', $undo);
    }
}