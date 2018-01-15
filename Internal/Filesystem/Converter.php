<?php namespace ZN\Filesystem;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Base;
use ZN\Filesystem\Exception\FileNotFoundException;

class Converter
{
    /**
     * Array to XLS
     * 
     * @param array  $data
     * @param string $file = 'excel.xls'
     */
    public static function arrayToXLS(Array $data, String $file = 'excel.xls')
    {
        $file = Base::suffix($file, '.xls');

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

    /**
     * CSV to Array
     * 
     * @param string $file
     * 
     * @return array
     */
    public static function CSVToArray(String $file) : Array
    {
        $file = Base::suffix($file, '.csv');

        if( ! is_file($file) )
        {
            throw new FileNotFoundException($file);
        }

        $row  = 1;
        $rows = [];

        if( ( $resource = fopen($file, "r") ) !== false )
        {
            while( ($data = fgetcsv($resource, 1000, ",")) !== false )
            {
                $num = count($data);

                $row++;
                
                for( $c = 0; $c < $num; $c++ )
                {
                    $rows[] = explode(';', $data[$c]);
                }
            }

            fclose($resource);
         }

         return $rows;
    }
}
