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

use ZN\FileSystem\Exception\FileNotFoundException;

class CSVToArray
{
    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(String $file) : Array
    {
        $file = suffix($file, '.csv');

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
