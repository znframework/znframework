<?php namespace ZN\Helpers\Searcher;

class Data implements DataInterface
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
    // @param mixed  $searchData
    // @param mixed  $searchWord
    // @param string $output: boolean, position, string
    //
    //--------------------------------------------------------------------------------------------------------
    public function do($searchData, $searchWord, String $output = 'boolean')
    {
        if( ! is_array($searchData) )
        {
            if( $output === 'string' )
            {
                return strstr($searchData, $searchWord);
            }
            elseif( $output === 'position' )
            {
                return strpos($searchData, $searchWord);
            }
            elseif( $output === 'boolean' )
            {
                $result = strpos($searchData, $searchWord);

                if( $result > -1 )
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            $result = array_search($searchWord, $searchData);

            if( $output === 'position' )
            {
                if( ! empty($result) )
                {
                    return $result;
                }
                else
                {
                    return -1;
                }
            }
            elseif( $output === 'boolean' )
            {
                if( ! empty($result) )
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            elseif( $output === 'string' )
            {
                if( ! empty($result) )
                {
                    return $searchWord;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
    }
}
