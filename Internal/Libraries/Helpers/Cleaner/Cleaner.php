<?php namespace ZN\Helpers;

class InternalCleaner extends \CallController implements CleanerInterface
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
    // Data
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param mixed $searchData
    // @param mixed $cleanWord
    //
    //--------------------------------------------------------------------------------------------------------
    public function data($searchData, $cleanWord)
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