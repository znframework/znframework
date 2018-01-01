<?php namespace ZN\FileSystem\Excel;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class ArrayToXLS
{
    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $data
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(Array $data, String $file = 'excel.xls')
    {
        $file = suffix($file, '.xls');

        header("Content-Disposition: attachment; filename=\"$file\"");
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");

        $output = fopen("php://output", 'w');

        foreach( $data as $column )
        {
            fputcsv($output, $column, "\t");
        }

        fclose($output);
    }
}
