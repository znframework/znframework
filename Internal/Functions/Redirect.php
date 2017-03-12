<?php
//--------------------------------------------------------------------------------------------------
// Redirect
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// redirect()
//--------------------------------------------------------------------------------------------------
//
// @param string $url
// @param int    $time
// @param array  $data
// @param bool   $exit
//
//--------------------------------------------------------------------------------------------------
function redirect(String $url, Int $time = 0, Array $data = [], Bool $exit = true)
{
    if( ! isUrl($url) )
    {
        $url = siteUrl($url);
    }

    if( ! empty($data) )
    {
        foreach( $data as $k => $v )
        {
            Session::insert('redirect:' . $k, $v);
        }
    }

    if( $time > 0 )
    {
        sleep($time);
    }

    header('Location: ' . $url, true);

    if( $exit === true )
    {
        exit;
    }
}

//--------------------------------------------------------------------------------------------------
// redirectData()
//--------------------------------------------------------------------------------------------------
//
// @param string $k
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function redirectData(String $k)
{
    if( $data = Session::select('redirect:'.$k) )
    {
        return $data;
    }
    else
    {
        return false;
    }
}

//--------------------------------------------------------------------------------------------------
// redirectDeleteData()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $data
//
// @return bool
//
//--------------------------------------------------------------------------------------------------
function redirectDeleteData($data) : Bool
{
    if( is_array($data) ) foreach( $data as $v )
    {
        Session::delete('redirect:'.$v);
    }
    else
    {
        return Session::delete('redirect:'.$data);
    }

    return true;
}
