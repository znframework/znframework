<?php namespace ZN\FileSystem\Excel;

class ArrayToXLS
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $data
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(Array $data, String $file = 'excel.xls')
    {
        $file = suffix($file, '.xls');

        header("Content-Disposition: attachment; filename=\"$file\"");
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");

        if( ! empty($this->rows) )
        {
            $data = $this->rows;
            $this->rows = NULL;
        }

        $output = fopen("php://output", 'w');

        foreach( $data as $column )
        {
            fputcsv($output, $column, "\t");
        }

        fclose($output);
    }
}
