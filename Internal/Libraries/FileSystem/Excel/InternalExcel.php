<?php namespace ZN\FileSystem;

use CallController;

class InternalExcel extends CallController implements InternalExcelInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Array To XLS
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $data
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function arrayToXLS(Array $data, String $file = 'excel.xls')
    {
        return ExcelFactory::class('ArrayToXLS')->do($data, $file);
    }

    //--------------------------------------------------------------------------------------------------------
    // CSV To Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function CSVToArray(String $file) : Array
    {
        return ExcelFactory::class('CSVToArray')->do($file);
    }
}
