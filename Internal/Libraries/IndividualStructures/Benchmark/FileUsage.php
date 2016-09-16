<?php namespace ZN\IndividualStructures\Benchmark;

class FileUsage
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
    // Used Files
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $result
    // @return numeric
    //
    //--------------------------------------------------------------------------------------------------------
    public function list(String $result = NULL) : Array
    {
        if( empty($result) )
        {
            return get_required_files();
        }

        $resend  = $result."_end";
        $restart = $result."_start";

        if( isset(Properties::$usedtests[$resend]) && isset(Properties::$usedtests[$restart]) )
        {
            return array_diff(Properties::$usedtests[$resend], Properties::$usedtests[$restart]);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Used File Count
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $result
    // @return numeric
    //
    //--------------------------------------------------------------------------------------------------------
    public function count(String $result = NULL) : Int
    {
        if( empty($result) )
        {
            return count(get_required_files());
        }

        $resend  = $result."_end";
        $restart = $result."_start";

        if( isset(Properties::$usedtests[$resend]) && isset(Properties::$usedtests[$restart]) )
        {
            return count(Properties::$usedtests[$resend]) - count(Properties::$usedtests[$restart]);
        }
    }
}
