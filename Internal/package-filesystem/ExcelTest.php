<?php namespace ZN\Filesystem;

use Excel;

class ExcelTest extends FilesystemExtends
{
    public function testArrayToXLS()
    {
        Excel::arrayToXLS
        ([
            ['1', '2', '3'],
            ['1', '2', '3']
        ], 'excel');
    }

    public function testCSVToArray()
    {
        $this->assertIsArray(Excel::CSVToArray(self::directory . 'test'));
    }
}