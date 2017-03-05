<?php
//--------------------------------------------------------------------------------------------------
// Starting
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Ob Start
//--------------------------------------------------------------------------------------------------
//
// Tampon başlatılıyor.
//
//--------------------------------------------------------------------------------------------------
if( Config::get('IndividualStructures', 'cache')['obGzhandler'] && substr_count(server('acceptEncoding'), 'gzip') )
{
    ob_start('ob_gzhandler');
}
else
{
    ob_start();
}
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Headers
//--------------------------------------------------------------------------------------------------
//
// Başlık bilgileri düzenleniyor.
//
//--------------------------------------------------------------------------------------------------
headers(Config::get('General', 'headers'));
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Set Error Handler
//--------------------------------------------------------------------------------------------------
//
// Yakanalan hata set ediliyor.
//
//--------------------------------------------------------------------------------------------------
if( PROJECT_MODE !== 'publication' )
{
    set_error_handler('Exceptions::table');
}
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// INI Ayarlarını Yapılandırma İşlemi
//--------------------------------------------------------------------------------------------------
$iniSet = Config::get('Htaccess', 'ini')['settings'];

if( ! empty($iniSet) )
{
    Config::iniSet($iniSet);
}
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Htaccess Dosyası Oluşturma İşlemi
//--------------------------------------------------------------------------------------------------
if( Config::get('Htaccess','createFile') === true )
{
    internalCreateHtaccessFile();
}
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Robots Dosyası Oluşturma İşlemi
//--------------------------------------------------------------------------------------------------
if( Config::get('Robots','createFile') === true )
{
    internalCreateRobotsFile();
}
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Invalid Request Page
//--------------------------------------------------------------------------------------------------------
$invalidRequest = Config::get('Services', 'route')['invalidRequest'];

if( $invalidRequest['control'] === true && Http::isInvalidRequest() )
{
    if( ! in_array(strtolower(CURRENT_CFURI), array_map('strtolower', $invalidRequest['allowPages'])) )
    {
        if( empty($invalidRequest['page']) )
        {
            trace(lang('Error', 'invalidRequest'));
        }

        redirect($invalidRequest['page']);
    }
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Composer Autoloader
//--------------------------------------------------------------------------------------------------
$composer = Config::get('Autoloader', 'composer');

if( $composer === true )
{
    $path = 'vendor/autoload.php';

    if( file_exists($path) )
    {
        import($path);
    }
    else
    {
        report('Error', lang('Error', 'fileNotFound', $path) ,'AutoloadComposer');

        die(Errors::message('Error', 'fileNotFound', $path));
    }
}
elseif( is_file($composer) )
{
    require_once($composer);
}
elseif( ! empty($composer) )
{
    report('Error', lang('Error', 'fileNotFound', $composer) ,'AutoloadComposer');

    die(Errors::message('Error', 'fileNotFound', $composer));
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Autoload Files
//--------------------------------------------------------------------------------------------------------
if( $starting['autoload']['status'] === true )
{
    $startingAutoload       = Folder::allFiles(AUTOLOAD_DIR, $starting['autoload']['recursive']);
    $commonStartingAutoload = Folder::allFiles(EXTERNAL_AUTOLOAD_DIR, $starting['autoload']['recursive']);

    if( ! empty($startingAutoload) ) foreach( $startingAutoload as $file )
    {
        if( extension($file) === 'php' )
        {
            if( is_file($file) )
            {
                import($file);
            }
        }
    }

    if( ! empty($commonStartingAutoload) ) foreach( $commonStartingAutoload as $file )
    {
        if( extension($file) === 'php' )
        {
            $commonIsSameExistsFile = str_ireplace(EXTERNAL_AUTOLOAD_DIR, AUTOLOAD_DIR, $file);

            if( ! is_file($commonIsSameExistsFile) && is_file($file) )
            {
                import($file);
            }
        }
    }
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Handload Files
//--------------------------------------------------------------------------------------------------------
if( ! empty($starting['handload']) )
{
    Import::handload(...$starting['handload']);
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Starting Controllers
//--------------------------------------------------------------------------------------------------------
$starting        = Config::get('Starting');
$startController = $starting['controller'];

if( ! empty($startController) )
{
    if( is_string($startController) )
    {
        internalStartingContoller($startController);
    }
    elseif( is_array($startController) )
    {
        foreach( $startController as $key => $val )
        {
            if( is_numeric($key) )
            {
                internalStartingContoller($val);
            }
            else
            {
                internalStartingContoller($key, $val);
            }
        }
    }
}
//--------------------------------------------------------------------------------------------------------
