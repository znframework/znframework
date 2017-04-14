<?php namespace ZN\ViewObjects\View\BS;

use BS;

class Badge implements BadgeInterface
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
    // Badge Link
    //--------------------------------------------------------------------------------------------------------
    //
    // @paran int    $badge = 5
    //
    //--------------------------------------------------------------------------------------------------------
    public function badge(Int $badge = 5) : String
    {
        return '<span class="badge">' . $badge . '</span>';
    }

    //--------------------------------------------------------------------------------------------------------
    // Badge Link
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url   = NULL
    // @param string $value = NULL
    // @paran int    $badge = 5
    //
    //--------------------------------------------------------------------------------------------------------
    public function badgeLink(String $url = NULL, String $value = NULL, Int $badge = 5) : String
    {
        $return = BS::type(Properties::$type)->buttonLink($url, $value . ' ' . $this->badge($badge));

        Properties::$type = NULL;

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Badge Link
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name  = NULL
    // @param string $value = NULL
    // @paran int    $badge = 5
    //
    //--------------------------------------------------------------------------------------------------------
    public function badgeButton(String $name = NULL, String $value = NULL, Int $badge = 5) : String
    {
        $return = '<button type="button" name="'.$name.'" class="btn btn-'.(Properties::$type ?? 'primary').'">'.$value.' '.$this->badge($badge).'</button>';

        Properties::$type = NULL;

        return $return;
    }
}
