<?php namespace ZN\ViewObjects\View\BS;

use URI;

class Pagination implements PaginationInterface
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
    // Protected URL
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $url = CURRENT_CFURL;

    //--------------------------------------------------------------------------------------------------------
    // URL
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    //
    //--------------------------------------------------------------------------------------------------------
    public function url(String $url) : Pagination
    {
        if( ! isUrl($url) )
        {
            $url = siteUrl($url);
        }

        $this->url = $url;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $pageCount = 5
    // @param int $active    = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(Int $pageCount = 5, Int $active = NULL) : String
    {
        $active  = $active ?? (int) URI::segment(-1);
        $size    = Properties::$size ? ' pagination-' . Properties::$size : NULL;

        $return  = '<ul class="pagination' . $size  . '">' . EOL;

        for( $index = 1; $index <= $pageCount; $index++ )
        {
            $return .= '<li' . ($active === $index ? ' class="active"' : NULL) . '><a href="'. suffix($this->url) . $index . '">' . $index . '</a></li>' . EOL;
        }

        $return .= '</ul>';

        Properties::$size = NULL;

        return $return;
    }
}
