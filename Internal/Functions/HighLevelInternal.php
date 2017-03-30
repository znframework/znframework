<?php
//--------------------------------------------------------------------------------------------------
// High Level Internal
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// internalProjectContainerDir)
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @param string
//
//--------------------------------------------------------------------------------------------------
function internalProjectContainerDir($path = NULL) : String
{
    $path                = suffix($path, DS);
    $containers          = PROJECTS_CONFIG['containers'];
    $containerProjectDir = PROJECT_DIR . $path;

    if( ! empty($containers) && defined('_CURRENT_PROJECT') )
    {
        return ! empty($containers[_CURRENT_PROJECT]) && ! file_exists($containerProjectDir)
               ? PROJECTS_DIR . suffix($containers[_CURRENT_PROJECT], DS) . $path
               : $containerProjectDir;
    }

    return $containerProjectDir;
}

//--------------------------------------------------------------------------------------------------
// Project Mode
//--------------------------------------------------------------------------------------------------
//
// @param string $mode: publication, development, restoration
// @param int    $report: -1
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function internalProjectMode(String $mode, Int $report = -1)
{
    //----------------------------------------------------------------------------------------------
    // Kullanılabilir Uygulama Seçenekleri
    //----------------------------------------------------------------------------------------------
    switch( strtolower($mode) )
    {
        //------------------------------------------------------------------------------------------
        // Publication Yayın Modu
        // Tüm hatalar kapalıdır.
        // Projenin tamamlanmasından sonra bu modun kullanılması önerilir.
        //------------------------------------------------------------------------------------------
        case 'publication' :
            error_reporting(0);
        break;
        //------------------------------------------------------------------------------------------

        //------------------------------------------------------------------------------------------
        // Restoration Onarım Modu
        // Hataların görünümü görecelidir.
        //------------------------------------------------------------------------------------------
        case 'restoration' :
        //------------------------------------------------------------------------------------------
        // Development Geliştirme Modu
        // Tüm hatalar açıktır.
        //------------------------------------------------------------------------------------------
        case 'development' :
            error_reporting($report);
        break;
        //------------------------------------------------------------------------------------------

        //------------------------------------------------------------------------------------------
        // Farklı bir kullanım hatası
        //------------------------------------------------------------------------------------------
        default: trace('Invalid Application Mode! Available Options: ["development"], ["restoration"] or ["publication"]');
        //------------------------------------------------------------------------------------------
    }
    //----------------------------------------------------------------------------------------------
}

//--------------------------------------------------------------------------------------------------
// internalOutput()
//--------------------------------------------------------------------------------------------------
//
// @param mixed  $data
// @param string $tab      = ''
// @param int    $start    = 0
// @param array  $settings = []
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalOutput($data, String $tab = NULL, Int $start = 0, Array $settings = []) : String
{
    static $start;

    $lengthColor    = $settings['lengthColor']  ?? 'grey';
    $keyColor       = $settings['keyColor']     ?? '#000';
    $typeColor      = $settings['typeColor']    ?? '#8C2300';
    $stringColor    = $settings['stringColor']  ?? 'red';
    $numericColor   = $settings['numericColor'] ?? 'green';

    $output = '';
    $eof    = '<br>';
    $tab    = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $start);

    $lengthstyle = ' style="color:'.$lengthColor.'"';
    $keystyle    = ' style="color:'.$keyColor.'"';
    $typestyle   = ' style="color:'.$typeColor.'"';

    $vartype = 'array';

    if( is_object($data) )
    {
        $data = (array) $data;
        $vartype = 'object';
    }

    if( ! is_array($data) )
    {
        return $data.$eof;
    }
    else
    {
        foreach( $data as $k => $v )
        {
            if( is_object($v) )
            {
                $v = (array) $v;
                $vartype = 'object';
            }

            if( ! is_array($v) )
            {
                $valstyle  = ' style="color:'.$numericColor.';"';

                $type = gettype($v);

                if( $type === 'string' )
                {
                    $v = "'".$v."'";
                    $valstyle = ' style="color:'.$stringColor.';"';

                    $type = 'string';
                }
                elseif( $type === 'boolean' )
                {
                    $v = ( $v === true ) ? 'true' : 'false';

                    $type = 'boolean';
                }

                $output .= "$tab<span$keystyle>$k</span> => <span$typestyle>$type</span> <span$valstyle>$v</span> <span$lengthstyle>( length = ".strlen($v)." )</span>$eof";
            }
            else
            {
                $output .= "$tab<span$keystyle>$k</span> => <span$typestyle>$vartype</span> $eof $tab( $eof ".internalOutput($v, $tab, (int) $start++)." $tab) ".$eof;
                $start--;
            }
        }
    }

    return $output;
}

//--------------------------------------------------------------------------------------------------
// Internal Objects
//--------------------------------------------------------------------------------------------------
//
// @param array    $array
// @param stdClass $obj
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalObjects(Array $array, stdClass &$std) : stdClass
{
    foreach( $array as $key => $value )
    {
        if( is_array($value) )
        {
            $std->$key = new stdClass;

            internalObjects($value, $std->$key);
        }
        else
        {
            $std->$key = $value;
        }
    }

    return $std;
}

//--------------------------------------------------------------------------------------------------
// Internal Current Project
//--------------------------------------------------------------------------------------------------
//
// @param void
//
//--------------------------------------------------------------------------------------------------
function internalCurrentProject()
{
    $projectConfig = PROJECTS_CONFIG['directory']['others'];
    $projectDir    = $projectConfig;
    
    if( defined('CONSOLE_PROJECT_NAME') )
    {
        $internalDir = CONSOLE_PROJECT_NAME;
    }
    else
    {
        $currentPath   = server('currentPath');
        $internalDir   = ( ! empty($currentPath) ? explode('/', ltrim($currentPath, '/'))[0] : '' );
    }

    if( is_array($projectDir) )
    {
        $internalDir = $projectDir[$internalDir] ?? $internalDir;
        $projectDir  = $projectDir[host()] ?? DEFAULT_PROJECT;
    }

    if( ! empty($internalDir) && is_dir(PROJECTS_DIR . $internalDir) )
    {
        define('_CURRENT_PROJECT', $internalDir);

        $flip              = array_flip($projectConfig);
        $projectDir        = _CURRENT_PROJECT;
        $currentProjectDir = $flip[$projectDir] ?? $projectDir;
    }

    define('CURRENT_PROJECT', $currentProjectDir ?? $projectDir);
    define('PROJECT_DIR', suffix(PROJECTS_DIR . $projectDir, DS));

    if( ! is_dir(PROJECT_DIR) )
    {
        trace('["'.$projectDir.'"] Project Directory Not Found!');
    }
}
