<?php namespace ZN\Filesystem;

use Excel;

class ExcelTest extends \PHPUnit\Framework\TestCase
{
    const directory = 'UnitTests/package-filesystem/resources/';

    public function testArrayToXLS()
    {
        Excel::arrayToXLS
        ([
            ['1', '2', '3'],
            ['1', '2', '3']
        ],  'excel-file', false);
    }

    public function testCSVToArray()
    {
        $this->assertIsArray(Excel::CSVToArray(self::directory . 'test'));
    }
}