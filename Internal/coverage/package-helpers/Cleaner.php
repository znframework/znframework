<?php namespace ZN\Helpers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Helpers\Exception\LogicException;

class Cleaner
{
    /**
     * Clean Data
     * 
     * @param mixed $searchData
     * @param mixed $cleanWord
     * 
     * @return mixed
     */
    public static function data($searchData, $cleanWord)
    {
        if( length($cleanWord) > length($searchData) )
        {
            throw new LogicException('[Cleaner::data()] -> 3.($cleanWord) parameter not be longer than 2.($searchData) parameter!');
        }

        if( ! is_array($searchData) )
        {
            $result = str_replace($cleanWord, '', $searchData);
        }
        else
        {
            if( ! is_array($cleanWord) )
            {
                $cleanWordArray[] = $cleanWord;
            }
            else
            {
                $cleanWordArray = $cleanWord;
            }

            $result = array_diff($searchData, $cleanWordArray);
        }

        return $result;
    }
}
