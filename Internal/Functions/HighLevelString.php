<?php
//--------------------------------------------------------------------------------------------------
// High Level String
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Objects
//--------------------------------------------------------------------------------------------------
//
// @param array $array
//
// @return object
//
//--------------------------------------------------------------------------------------------------
function objects(array $array) : stdClass
{
    $object = new stdClass;

    return internalObjects($array, $object);
}

//--------------------------------------------------------------------------------------------------
// charsetList()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return array
//
//--------------------------------------------------------------------------------------------------
function charsetList() : array
{
    return mb_list_encodings();
}

//--------------------------------------------------------------------------------------------------
// compare()
//--------------------------------------------------------------------------------------------------
//
// @param string $p1
// @param string $p2
// @param string $p3
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function compare(string $p1, string $operator, string $p2) : bool
{
    return version_compare($p1, $p2, $operator);
}

//--------------------------------------------------------------------------------------------------
// EOL
//--------------------------------------------------------------------------------------------------
//
// @param int $repeat = 1
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function eol(int $repeat = 1) : string
{
    return str_repeat(EOL, $repeat);
}

//--------------------------------------------------------------------------------------------------
// getOS()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function getOS() : string
{
    if( stristr(PHP_OS, 'WIN') )
    {
        return 'WIN';
    }
    elseif( stristr(PHP_OS, 'MAC') )
    {
        return 'MAC';
    }
    elseif( stristr(PHP_OS, 'LINUX') )
    {
        return 'LINUX';
    }
    elseif( stristr(PHP_OS, 'UNIX') )
    {
        return 'UNIX';
    }
    else
    {
        return 'UNKNOWN';
    }
}

//--------------------------------------------------------------------------------------------------
// suffix()
//--------------------------------------------------------------------------------------------------
//
// @param string $string
// @param string $fix = '/'
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function suffix( ? string $string, string $fix = '/') : string
{
    if( strlen($fix) <= strlen($string) )
    {
        $suffix = substr($string, -strlen($fix));

        if( $suffix !== $fix)
        {
            $string = $string.$fix;
        }
    }
    else
    {
        $string = $string.$fix;
    }

    if( $string === '/' )
    {
        return false;
    }

    return $string;
}

//--------------------------------------------------------------------------------------------------
// prefix()
//--------------------------------------------------------------------------------------------------
//
// @param string $string
// @param string $fix = '/'
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function prefix( ? string $string, string $fix = '/') : string
{
    if( strlen($fix) <= strlen($string) )
    {
        $prefix = substr($string, 0, strlen($fix));

        if( $prefix !== $fix )
        {
            $string = $fix.$string;
        }
    }
    else
    {
        $string = $fix.$string;
    }

    if( $string === '/' )
    {
        return false;
    }

    return $string;
}

//--------------------------------------------------------------------------------------------------
// presuffix()
//--------------------------------------------------------------------------------------------------
//
// @param string $string
// @param string $fix = '/'
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function presuffix( ? string $string, string $fix = '/') : string
{
    return suffix(prefix($string, $fix), $fix);
}

//--------------------------------------------------------------------------------------------------
// divide()
//--------------------------------------------------------------------------------------------------
//
// @param string $str
// @param string $separator = '|'
// @param scalar $index     = 0
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function divide( ? string $str, string $separator = '|', string $index = '0')
{
    $arrayEx      = explode($separator, $str);
    $countArrayEx = count($arrayEx);

    if( $index === 'all' )
    {
        return $arrayEx;
    }

    if( $index < 0 )
    {
        $ind = $countArrayEx + $index;
    }
    elseif( $index === 'last' )
    {
        $ind = $countArrayEx - 1;
    }
    elseif( $index === 'first' )
    {
        $ind = 0;
    }
    else
    {
        $ind = $index;
    }

    return $arrayEx[$ind] ?? NULL;
}

//--------------------------------------------------------------------------------------------------
// lastError()
//--------------------------------------------------------------------------------------------------
//
// @param string $type = NULL
//
// @param mixed
//
//--------------------------------------------------------------------------------------------------
function lastError( ? string $type = NULL)
{
    $result = error_get_last();

    if( $type === NULL )
    {
        return $result;
    }
    else
    {
        return $result[$type] ?? NULL;
    }
}
