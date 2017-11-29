<?php namespace ZN\Helpers;

use ZN\Helpers\Exception\LogicException;

class Cleaner
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
    // @param mixed $searchData
    // @param mixed $cleanWord
    //
    //--------------------------------------------------------------------------------------------------------
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
