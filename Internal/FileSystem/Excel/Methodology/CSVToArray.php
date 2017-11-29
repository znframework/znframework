<?php namespace ZN\FileSystem\Excel;

use ZN\FileSystem\Exception\FileNotFoundException;

class CSVToArray
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
