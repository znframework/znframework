<?php namespace ZN\Helpers\Cleaner;

class CleanerData
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
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $searchData
    // @param mixed $cleanWord
    //
    //--------------------------------------------------------------------------------------------------------
    public function do($searchData, $cleanWord)
    {
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
