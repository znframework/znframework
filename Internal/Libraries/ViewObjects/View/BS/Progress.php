<?php namespace ZN\ViewObjects\View\BS;

class Progress implements ProgressInterface
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
    // Bar
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $value   = NULL
    // @param int    $percent = 0
    //
    //--------------------------------------------------------------------------------------------------------
    public function bar(String $value = NULL, Int $percent = 0) : String
    {
        $bar    = Properties::$type ? ' progress-bar-' . Properties::$type : NULL;
        $return = '<div class="progress">' . EOL .
                  '<div class="progress-bar' . $bar . '" role="progressbar" aria-valuenow="' . $percent . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $percent.'%">' . EOL . $value . EOL .
                  '</div>' . EOL . '</div>';

        Properties::$type = NULL;

        return $return;
    }
}
