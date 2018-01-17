<?php namespace ZN\Commands;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use Lang;

class Result
{
    /**
     * Magic constructor
     * 
     * @param mixed $result
     * 
     * @return void
     */
    public function __construct($result)
    {
        echo '+-------------------------------------------------------------------------------------------------------+' . EOL;
        echo '| RESULT                                                                                                |' . EOL;
        echo '+-------------------------------------------------------------------------------------------------------+' . EOL;

        $success = Lang::select('Success', 'success');
        $error   = Lang::select('Error', 'error');
        $nodata  = 'No Data';

        if( $result === true || $result === NULL )
        {
            echo $success;
        }
        elseif( $result === false )
        {
            echo $error;
        }
        else
        {
            if( is_array($result) )
            {
                if( ! empty($result) )
                {
                    print_r($result);
                }
                else
                {
                    echo $nodata;
                }
            }
            else
            {
                if( ! empty($result) )
                {
                    echo $result;
                }
                else
                {
                    echo $nodata;
                }
            }
        }

        echo EOL . '+-------------------------------------------------------------------------------------------------------+' . EOL;
    }
}